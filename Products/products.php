<?php
    require($_SERVER['DOCUMENT_ROOT'] . "/Models/" . "Basket.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/Models/" . "Product.php");
    session_start();
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = new Basket();
    }

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Products";

require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'functions.php');

    $Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ?", "ii", 0, 1000);

    //Check for filtering
    if (isset($_GET['FilterSubmit'])) {
        ?>
        <script>
            let url = window.location.href;
            if (url.startsWith("https://localhost/products/?")) {
                window.location.href = "https://localhost/products/Price=<?php echo $_GET['PriceRange'];?>/Type=<?php echo $_GET['BikeType'];?>/Colour=<?php echo $_GET['ColourType'];?>/"
            }
            console.log("URL: " + url);
        </script>
        <?php
        //Filter by price firstly
        if ($Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ?", "ii", 0, $_GET['PriceRange']) != null) {
            $Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ?", "ii", 0, $_GET['PriceRange']);
            //Filter by Bike Type and then if Colour is set filter by it
            if ($_GET['BikeType'] != "None") {
                $Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ? AND Type = ?", "iis", 0, (int)$_GET['PriceRange'], $_GET['BikeType']);
                if (count($Bikes) == 0) {
                    $Bikes = null;
                    $message = "No products available with chosen filter";
                }
                //Check if colour is chosen
                if ($_GET['ColourType'] != "None") {
                    $Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ? AND Type = ? AND Colour = ?", "iiss", 0, (int)$_GET['PriceRange'], $_GET['BikeType'], $_GET['ColourType']);
                    if (count($Bikes) == 0) {
                        $Bikes = null;
                        $message = "No products available with chosen filter";
                    }
                }
            }
            //Filter by Colour Type and then if Bike Type is set filter by it (Opposite of above to accommodate all filters) Price, Type, Colour, Price, Type, Price, Colour
            if ($_GET['ColourType'] != "None") {
                $Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ? AND Colour = ?", "iis", 0, (int)$_GET['PriceRange'], $_GET['ColourType']);
                if (count($Bikes) == 0) {
                    $Bikes = null;
                    $message = "No products available with chosen filter";
                }
                if ($_GET['BikeType'] != "None") {
                    $Bikes = functions::Filter("SELECT * FROM products WHERE Price BETWEEN ? AND ? AND Type = ? AND Colour = ?", "iiss", 0, (int)$_GET['PriceRange'], $_GET['BikeType'], $_GET['ColourType']);
                    if (count($Bikes) == 0) {
                        $Bikes = null;
                        $message = "No products available with chosen filter";
                    }
                }
            }
        } else {
            $message = "No products available with chosen filter";
            $Bikes = null;
        }

    }
?>

<!--Creating the product filter menu and the product viewing list-->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark">
            <div class="card border border-0 bg-dark text-light p-2 sticky-top">
                <h5 class="text-center" style="margin-bottom: 2rem; margin-top: 2rem;">Filters</h5>
                <form class="bg-light text-dark p-2 rounded" method="get" action="/products/">
                    <div class="form-group">
                        <label id="PriceRangeLabel" for="PriceRange">Price Range: £0 - £<?php if (isset($_GET['PriceRange'])) {echo (int)$_GET['PriceRange'];} else {echo '1000'; }?></label><br>
                        <input type="range" class="form-range" id="PriceRange" min="0" max="1000" aria-valuemin="0" value="<?php if (isset($_GET['PriceRange'])) {echo (int)$_GET['PriceRange'];} else {echo '1000'; }?>" aria-valuemax="1000" name="PriceRange"/>
                    </div>
                    <div class="form-group mt-3">
                        <label for="BikeType">Bike Type:</label><br>
                        <select class="form-select mt-1 form-control" name="BikeType" aria-label="Bike Type Select">
                            <option value="None">None</option>
                            <?php
                                $Types = functions::GetBikeTypes();
                                for ($x = 0; $x<count($Types); $x++) {
                                    ?>
                                    <option <?php if (isset($_GET['BikeType']) && $_GET['BikeType'] == $Types[$x]) { echo 'selected '; }?>value="<?php echo $Types[$x]; ?>"><?php echo $Types[$x]; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="ColourType">Colour:</label><br>
                        <select class="form-select mt-1 form-control" name="ColourType" aria-label="Colour Type Select">
                            <option value="None">None</option>
                            <?php
                                $Colours = functions::GetColours();
                                for ($x = 0; $x<count($Colours); $x++) {
                                    ?>
                                    <!--Value is set to name of colour, if colour equals selected colour set to respective colour value -->
                                    <option value="<?php echo $Colours[$x]; ?>" <?php if (isset($_GET['ColourType']) && $_GET['ColourType'] == $Colours[$x]) { echo ' selected '; }?>><?php echo $Colours[$x]; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="AgeType">Age Type:</label><br>
                        <select class="form-select mt-1 form-control" name="AgeType" aria-label="Age Type Select" disabled>
                            <?php
                            ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" name="FilterSubmit" id="FilterSubmit">Filter</button>
                        <a href="/products/"><button type="button" class="btn btn-secondary" name="FilterReset" id="FilterReset">Reset</button></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-10 p-4">
            <div class="row">
                <?php
                    if ($Bikes == null) {
                        functions::SendMessage($message);
                    } else {
                foreach ($Bikes as $Bike) {
                    ?>
                <div class="col-sm-3 col-6 mb-4">
                    <div class="card p-2">
                        <div class="card-img-top">
                            <img src="/Media/Products/<?php if ($Bike->getSlug() == null) { echo 'default.png'; } else { echo $Bike->getSlug();}?>" class="img-fluid" style="max-height: 300px;" alt="A bicycle"/>
                        </div>
                        <div class="card-title text-left fw-bold">
                            <?php
                                echo $Bike->getName();
                            ?>
                        </div>
                        <div class="card-footer">
                            <div class="row my-auto">
                                <div class="col-md-5 col-12">
                                    <p class="text-left fw-bold fs-3">£<?php echo $Bike->getPrice(); ?></p>
                                </div>
                                <div class="col-md-7 col-12">
                                    <a href="product.php?id=<?php echo $Bike->getProductID();?>" class="btn btn-outline-primary w-100">View</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a class="btn btn-warning w-100" href="/basket/add/<?php echo $Bike->getProductID(); ?>/">Add to cart</a>
                                </div>
                            </div>
                            <br>
                            <div class="row my-auto">
                                <div class="col-md-6 col-12">
                                    <p class="text-left fs-6">Reviews (683)</p>
                                </div>
                                <div class="col-md-6 col-12">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fa fa-star-half-stroke"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                    }?>
            </div>
        </div>
    </div>
</div>

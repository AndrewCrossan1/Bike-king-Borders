<?php
    //Page Description: Provides a list of products for the user to see

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Products";

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Products";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require('../Scripts/header.php');
?>

<!--Creating the product filter menu and the product viewing list-->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark">
            <div class="card border border-0 bg-dark text-light p-2 sticky-top">
                <h5 class="text-center" style="margin-bottom: 2rem; margin-top: 2rem;">Filters</h5>
                <form class="bg-light text-dark p-2 rounded">
                    <div class="form-group">
                        <label id="PriceRangeLabel" for="PriceRange">Price Range: £0 - £1000</label><br>
                        <input type="range" class="form-range" id="PriceRange" min="0" max="1000" aria-valuemin="0" value="1000" aria-valuemax="1000" name="PriceRange"/>
                    </div>
                    <div class="form-group mt-3">
                        <label for="BikeType">Bike Type:</label><br>
                        <select class="form-select mt-1 form-control" name="BikeType" aria-label="Bike Type Select">
                            <option value="1" selected>None</option>
                            <option value="2">Mountain</option>
                            <option value="3">Hybrid</option>
                            <option value="4">Road</option>
                            <option value="5">Electric</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="ColourType">Colour:</label><br>
                        <select class="form-select mt-1 form-control" name="ColourType" aria-label="Colour Type Select">
                            <option value="1" selected>None</option>
                            <option value="2">Black</option>
                            <option value="3">Green</option>
                            <option value="4">Orange</option>
                            <option value="5">Blue</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="AgeType">Age Type:</label><br>
                        <select class="form-select mt-1 form-control" name="AgeType" aria-label="Age Type Select">
                            <option value="1" selected>None</option>
                            <option value="2">Adult</option>
                            <option value="3">Teenager</option>
                            <option value="4">Child</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-10 p-4">
            <div class="row justify-content-center">
                <?php for ($x = 0; $x < 16; $x++) {
                    ?>
                <div class="col-sm-3 col-6 mb-4">
                    <div class="card p-2 text-center">
                        <div class="card-img-top">
                            <img src="../Media/Images/bicycle.jpg" class="img-fluid" alt="A bicycle"/>
                        </div>
                        <div class="card-title">
                            Bike 1
                        </div>
                        <div class="card-body p-0">
                            <p>£6.00</p>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add to basket</button>
                        </div>
                    </div>
                </div>
                <?php
                }?>
            </div>
        </div>
    </div>
</div>

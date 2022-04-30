<?php
require($_SERVER['DOCUMENT_ROOT'] . "/Models/" . "Basket.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Models/" . "Product.php");
session_start();

function isimage($imgslug) {
    if ($imgslug == null) {
        return "/Media/" . "Products/" . "default.png";
    } else {
        return "/Media/" . "Products/" . $imgslug;
    }
}

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Your basket";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'functions.php');

$List = $_SESSION['basket']->getList();

?>
<body>
<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Review the items in your basket and click checkout to proceed</p>
        </div>
    </div>
</section>

<section class="h-100 pt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-75">
            <div class="col bg-light border rounded p-4">
                <div class="table-responsive rounded">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="h5">Your basket <span class="small fs-6 fw-normal">(<?php echo count($List);?> items in your basket)</span></th>
                            <th scope="col">Colour</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $TotalPrice = 0;
                        for ($x = 0; $x < count($List); $x++) {
                            ?>
                                <?php
                                $TotalPrice += $List[$x]->getPrice();
                                ?>
                            <tr class="rounded">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo isimage($List[$x]->getSlug()); ?>" class="img-fluid" alt="Product" style="max-width: 120px;"/>
                                        <div class="flex-column ms-4">
                                            <p><?php echo $List[$x]->getName();?></p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <p class="mb-0 fw-bold"><?php echo $List[$x]->getColour();?></p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-row">
                                        <button id="quantityDown" class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input id="form1" min="1" name="quantity<?php echo $x;?>" value="1" type="number" class="form-control form-control-sm" style="width: 50px;" />
                                        <button id="quantityUp" class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0 fw-bold" id="price">£<?php echo $List[$x]->getPrice();?></p>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="card mb-5 light-shadow mb-lg-0" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <div class="d-flex justify-content-between" style="font-weight: 500;">
                                    <p class="mb-2">Subtotal</p>
                                    <p class="mb-2">£<?php echo $TotalPrice;?></p>
                                </div>

                                <div class="d-flex justify-content-between" style="font-weight: 500;">
                                    <p class="mb-0">Shipping</p>
                                    <p class="mb-0"><?php $Shipping = 11.99; ?>£11.99</p>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-2" style="font-weight: 500;">
                                    <p class="mb-2">Total (tax included)</p>
                                    <p class="mb-2">£<?php echo $TotalPrice + $Shipping;?> <script></script></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="small">
                                        Discount code:
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between mb-4 w-100">
                                    <form method="post" action="/verifydiscount/">
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter discount code" name="discount" class="form-control rounded"/>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="submit">Enter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-primary btn-md">
                                    <div class="d-flex justify-content-between">
                                        <span>Continue to payment</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
</body>

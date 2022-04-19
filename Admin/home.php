<?php
session_start();
//Page Description: Allows the admin to manage current and historical offers

//Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
//Also keys is in with setting the pages active in header.php (Very fancy)
$PageName = "AdminHome";

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Admin Home";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once('../Scripts/functions.php');
require('../Scripts/adminheader.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}

//Data from database thats going into CanvasJS graph
//(Y axis will be number of sales)
//(X axis will be months of the year)
$DataPoints = array(
    array("y" => AdminFunctions::GetMonthSale(1), "label" => "January"),
    array("y" => AdminFunctions::GetMonthSale(2), "label" => "February"),
    array("y" => AdminFunctions::GetMonthSale(3), "label" => "March"),
    array("y" => AdminFunctions::GetMonthSale(4), "label" => "April"),
    array("y" => AdminFunctions::GetMonthSale(5), "label" => "May"),
    array("y" => AdminFunctions::GetMonthSale(6), "label" => "June"),
    array("y" => AdminFunctions::GetMonthSale(7), "label" => "July"),
    array("y" => AdminFunctions::GetMonthSale(8), "label" => "August"),
    array("y" => AdminFunctions::GetMonthSale(9), "label" => "September"),
    array("y" => AdminFunctions::GetMonthSale(10), "label" => "October"),
    array("y" => AdminFunctions::GetMonthSale(11), "label" => "November"),
    array("y" => AdminFunctions::GetMonthSale(12), "label" => "December"),
);

?>

<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Here you can manage products, users, offers and view activity on the site.</p>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-12 bg-dark">
            <!--Side navigation bar-->
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-light">Bike King Borders</h4>
                        <hr style="color: white;"/>
                        <div class="nav flex-column nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active text-light" aria-selected="true" href="/admin/home/">Home</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/products/">Products</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/offers/">Offers</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/users/" tabindex="-1">Users</a>
                            </li>
                            <hr style="color: white;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <?php
            if (isset($_REQUEST['message'])) {
                functions::SendMessage(base64_decode($_REQUEST['message']));
            }
            ?>
            <!--Main content-->
            <div class="container-fluid p-3">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-6">
                        <div class="card bg-primary p-3 my-2">
                            <div class="card-title text-left">
                                <p class="display-6" style="font-family: Ubuntu, Verdana; color: white;"><b><?php echo AdminFunctions::CountProducts();?></b></p>
                            </div>
                            <div class="card-body p-0 text-left" style="max-width: 18rem;">
                                <p class="lead text-light"><b>Products available</b></p>
                                <a href="/admin/products/" class="btn btn-outline-warning">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card bg-primary p-3 my-2">
                            <div class="card-title text-left">
                                <p class="display-6" style="font-family: Ubuntu, Verdana; color: white;"><b><?php echo AdminFunctions::CountUsers(); ?></b></p>
                            </div>
                            <div class="card-body p-0 text-left" style="max-width: 18rem;">
                                <p class="lead text-light"><b>Accounts created</b></p>
                                <a href="/admin/users/" class="btn btn-outline-warning">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card bg-primary p-3 my-2">
                            <div class="card-title text-left">
                                <p class="display-6" style="font-family: Ubuntu, Verdana; color: white;"><b><?php echo AdminFunctions::CountOffers(); ?></b></p>
                            </div>
                            <div class="card-body p-0 text-left" style="max-width: 18rem;">
                                <p class="lead text-light"><b>Active offers</b></p>
                                <a href="/admin/offers/" class="btn btn-outline-warning">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card bg-primary p-3 my-2">
                            <div class="card-title text-left">
                                <p class="display-6" style="font-family: Ubuntu, Verdana; color: white;"><b>56</b></p>
                            </div>
                            <div class="card-body p-0 text-left" style="max-width: 18rem;">
                                <p class="lead text-light"><b>Reviews made</b></p>
                                <a href="/admin/reviews/" class="btn btn-outline-warning">View all</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-12">
                        <div class="card bg-white border border-primary p-3 my-2">
                            <div class="card-title text-center">
                                <p class="lead text-primary">
                                    Newly added products
                                </p>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-responsive">
                                    <thead class="bg-black text-white">
                                    <th>ProductID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $array = AdminFunctions::RecentProducts();
                                    while ($row = $array->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['ProductID']; ?></td>
                                            <td><?php echo $row['Name']; ?></td>
                                            <td><?php echo $row['Price']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card bg-white border border-primary p-3 my-2">
                            <div class="card-title text-center">
                                <p class="lead text-primary">
                                    Newly added users
                                </p>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-responsive">
                                    <thead class="bg-black text-white">
                                    <th>AccountID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $array = AdminFunctions::RecentUsers();
                                    while ($row = $array->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['AccountID']; ?></td>
                                            <td><?php echo $row['Username']; ?></td>
                                            <td><?php echo $row['Email']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 col-12">
                        <div class="card-title bg-white border border-primary p-3 my-2 text-center">
                            <p class="lead text-primary">Recent Purchases</p>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-responsive">
                                    <thead class="bg-black text-white">
                                    <th>SaleID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Customer Name</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $array = AdminFunctions::RecentPurchases();
                                    while ($row = $array->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['SaleID'];?></td>
                                            <td><?php echo $row['Name'];?></td>
                                            <td><?php echo $row['Price'];?></td>
                                            <td><?php echo $row['Quantity'];?></td>
                                            <td><?php echo $row['Username'];?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <script>
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                title:{
                                    text: "Monthly Sales",
                                    fontColor: "white",
                                    fontSize: 30,
                                    backgroundColor: "black",
                                    padding: 10,
                                    cornerRadius: 5,
                                    fontWeight: "bold",
                                    fontFamily: "Ubuntu"
                                },
                                axisY: {
                                    title: "Number of sales"
                                },
                                data: [{
                                    type: "line",
                                    dataPoints: <?php echo json_encode($DataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            chart.render();
                        }
                    </script>
                    <div class="col-md-12 col-12">
                        <div class="card bg-white border border-primary p-3 my-2">
                            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Admin Home";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');


if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}

$Times = adminfunctions::ReadTimes();

if (isset($_POST['SubmitTimes'])) {
    $data = [
        ['Monday', $_POST['OpeningTimeMonday'], $_POST['ClosingTimeMonday']],
        ['Tuesday', $_POST['OpeningTimeTuesday'], $_POST['ClosingTimeTuesday']],
        ['Wednesday', $_POST['OpeningTimeWednesday'], $_POST['ClosingTimeWednesday']],
        ['Thursday', $_POST['OpeningTimeThursday'], $_POST['ClosingTimeThursday']],
        ['Friday', $_POST['OpeningTimeFriday'], $_POST['ClosingTimeFriday']],
        ['Saturday', $_POST['OpeningTimeSaturday'], $_POST['ClosingTimeSaturday']],
        ['Sunday', $_POST['OpeningTimeSunday'], $_POST['ClosingTimeSunday']]
    ];
    adminfunctions::WriteTimes($data);
}

//Data from database thats going into CanvasJS graph
//(Y axis will be number of sales)
//(X axis will be months of the year)
$DataPoints = array(
    array("y" => adminfunctions::GetMonthSale(1), "label" => "January"),
    array("y" => adminfunctions::GetMonthSale(2), "label" => "February"),
    array("y" => adminfunctions::GetMonthSale(3), "label" => "March"),
    array("y" => adminfunctions::GetMonthSale(4), "label" => "April"),
    array("y" => adminfunctions::GetMonthSale(5), "label" => "May"),
    array("y" => adminfunctions::GetMonthSale(6), "label" => "June"),
    array("y" => adminfunctions::GetMonthSale(7), "label" => "July"),
    array("y" => adminfunctions::GetMonthSale(8), "label" => "August"),
    array("y" => adminfunctions::GetMonthSale(9), "label" => "September"),
    array("y" => adminfunctions::GetMonthSale(10), "label" => "October"),
    array("y" => adminfunctions::GetMonthSale(11), "label" => "November"),
    array("y" => adminfunctions::GetMonthSale(12), "label" => "December"),
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
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/support/" tabindex="-1">Support Tickets</a>
                            </li>
                            <hr style="color: white;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <!--Main content-->
            <div class="container-fluid p-3">
                <?php
                if (isset($_GET['message'])) {
                    adminfunctions::SendMessage(base64_decode($_GET['message']));
                }
                ?>
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
                                <p class="display-6" style="font-family: Ubuntu, Verdana; color: white;"><b><?php echo AdminFunctions::CountTickets(); ?></b></p>
                            </div>
                            <div class="card-body p-0 text-left" style="max-width: 18rem;">
                                <p class="lead text-light"><b>Support Tickets</b></p>
                                <a href="/admin/support/" class="btn btn-outline-warning">View all</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-primary p-3 my-2">
                            <div class="card border">
                                <div class="card-header text-center">
                                    <h3 class="text-primary">Opening Times</h3>
                                </div>
                                <div class="card-body text-center">
                                    <div class="container-fluid">
                                        <form action="https://localhost/admin/home/" method="post">
                                            <div class="row">
                                                <div class="col-md-6">Monday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeMonday" value="<?php echo $Times[2][1] ;?>" required id="OpeningTimeMonday"> to <input type="text" required name="ClosingTimeMonday" value="<?php echo $Times[2][2] ;?>" id="ClosingTimeMonday"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Tuesday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeTuesday" value="<?php echo $Times[3][1] ;?>" required id="OpeningTimeTuesday"> to <input type="text" required name="ClosingTimeTuesday" value="<?php echo $Times[3][2] ;?>" id="ClosingTimeTuesday"></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Wednesday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeWednesday" value="<?php echo $Times[4][1] ;?>" required id="OpeningTimeWednesday"> to <input type="text" required name="ClosingTimeWednesday" value="<?php echo $Times[4][2] ;?>" id="ClosingTimeWednesday"></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Thursday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeThursday" value="<?php echo $Times[5][1] ;?>" required id="OpeningTimeThursday"> to <input type="text" required name="ClosingTimeThursday" value="<?php echo $Times[5][2] ;?>" id="ClosingTimeThursday"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Friday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeFriday" value="<?php echo $Times[6][1] ;?>" required id="OpeningTimeFriday"> to <input type="text" required name="ClosingTimeFriday" value="<?php echo $Times[6][2] ;?>" id="ClosingTimeFriday"></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Saturday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeSaturday" value="<?php echo $Times[7][1] ;?>" required id="OpeningTimeSaturday"> to <input type="text" required name="ClosingTimeSaturday" value="<?php echo $Times[7][2] ;?>" id="ClosingTimeSaturday"></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Sunday:</div>
                                                <div class="col-md-6"><input type="text" name="OpeningTimeSunday" value="<?php echo $Times[8][1] ;?>" required id="OpeningTimeSunday"> to <input type="text" required name="ClosingTimeSunday" value="<?php echo $Times[8][2] ;?>" id="ClosingTimeSunday"></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" name="SubmitTimes" id="SubmitTimes" class="btn btn-primary"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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


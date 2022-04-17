<?php
session_start();
//Page Description: Allows the admin to manage current and historical offers

//Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
//Also keys is in with setting the pages active in header.php (Very fancy)
$PageName = "AdminHome";

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Admin Home";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require('../Scripts/adminheader.php');
error_reporting(0);
if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}
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
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Offers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" tabindex="-1" aria-disabled="false">Users</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <!--Main content-->
            <div class="container-fluid p-5">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-12 text-center border">
                        <p class="lead fs-4 p-1">Newly added products</p>
                    </div>
                    <div class="col-md-4 col-12 text-center border">
                        <p class="lead fs-4 p-1">Newly added users</p>
                    </div>
                    <div class="col-md-4 col-12 text-center border">
                        <p class="lead fs-4 p-1">Newly added offers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


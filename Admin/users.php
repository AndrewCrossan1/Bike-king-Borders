<?php
session_start();
$PageTitle = "Manage users";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

//If user is not admin then leave
if (!isset($_SESSION['Admin'])) {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '/admin/login/';
        });
    </script>
    <?php
}
?>
<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Add, update or remove users.</p>
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
                                <a class="nav-link text-light" href="/admin/home/">Home</a>
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
                                <a class="nav-link text-light active" href="/admin/users/" tabindex="-1">Users</a>
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

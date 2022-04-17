<head>
    <!--Setting meta-data -->
    <meta name="author" content="Andrew Crossan"/>
    <meta name="description" content="Bike King Borders is a growing bike hiring service based in the borders of Scotland!"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Title-->
    <title><?php if (isset($PageTitle)) {echo $PageTitle;}?></title>
    <!--Importing bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/JS/base.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b4c6b2d3ed.js" crossorigin="anonymous"></script>
    <!--Importing local javascript file-->
    <script src="/JS/base.js"></script>
    <!--Importing local css file-->
    <link href="/CSS/base.css" rel="stylesheet"/>
</head>

<!--Admin Header-->
<?php
if (isset($PageName) && str_contains($PageName, "Admin")) {
    ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark p-3">
    <div class="container-fluid">
        <a id="logoutadmin" class="navbar-brand" href="/home/">Bike King Borders</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
                <!-- Home -->
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'AdminHome') { echo ' active'; }?>" href="/admin/home/"><i class="fas fa-house"></i> Home</a>
                </li>
                <!-- Products View -->
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'AdminProducts') { echo ' active'; }?>" href="/admin/products/"><i class="fas fa-rectangle-list"></i> Products</a>
                </li>
                <!-- Offers View -->
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'AdminOffers') { echo ' active'; }?>" href="/admin/offers/"><i class="fas fa-rectangle-list"></i> Offers</a>
                </li>
                <!-- Users View -->
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'AdminUsers') { echo ' active'; }?>" href="/admin/users/"><i class="fas fa-user"></i> Users</a>
                </li>
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'AdminLogout') { echo ' active'; }?>" href="/admin/logout/"><i class="fas fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <?php
}
?>

<!--Normal Header-->



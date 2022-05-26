<?php
define("MEDIA_URL", $_SERVER['DOCUMENT_ROOT']. "/Media/");
function isimageset($imgslug) {
    if ($imgslug == null) {
        return "/Media/" . "Products/" . "default.png";
    } else {
        return "/Media/" . "Products/" . $imgslug;
    }
}
?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/JS/base.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b4c6b2d3ed.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!--Importing local javascript file-->
    <script src="/JS/base.js"></script>
    <script src="/JS/Cookies.js"></script>
    <!--Importing local css file-->
    <link href="/CSS/base.css" rel="stylesheet"/>
    <link href="/Media/Images/icon.ico" rel="icon"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)">Bike King Borders</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
                <!-- Home -->
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'Index') { echo ' active'; }?>" href="/home/"  data-bs-toggle="tooltip" title="CTRL + H" data-bs-placement="bottom"><i class="fas fa-house"></i> Home</a>
                </li>
                <!--Basket-->
                <li class="nav-item m-2 middle">
                    <a class="nav-link" href="/basket/" data-bs-toggle="tooltip" title="CTRL + B" data-bs-placement="bottom">
                        <i class="fa fa-shopping-basket"></i> Basket
                    </a>
                </li>
                <!--Local Area-->
                <li class="nav-item m-2 middle">
                    <a class="nav-link" href="/localarea/" data-bs-toggle="tooltip" title="CTRL + L" data-bs-placement="bottom">
                        <i class="fa fa-globe"></i> Local Area
                    </a>
                </li>
                <li class="nav-item m-2 middle">
                    <a class="nav-link" href="/offers/" data-bs-toggle="tooltip" title="CTRL + O" data-bs-placement="bottom">
                        <i class="fa fa-money-bill"></i> Offers
                    </a>
                </li>
                <!--Gallery-->
                <li class="nav-item m-2 middle">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == "Gallery") { echo ' active'; }?>" href="/gallery/" data-bs-toggle="tooltip" title="CTRL + G" data-bs-placement="bottom"><i class="fas fa-photo-film"></i> Gallery</a>
                </li>
                <!-- Account Dropdown menu -->
                <li class="nav-item dropdown m-2 middle">
                    <a class="nav-link dropdown-toggle <?php if (isset($PageName) && $PageName == "Accounts") { echo ' active'; }?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user"></i> Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if (!isset($_SESSION['loggedin'])) {?>
                            <li>
                                <a class="dropdown-item" href="/account/login/">Login</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/account/create/">Create an account</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">Forgot your password?</a>
                            </li>
                        <?php } else {?>
                            <li>
                                <a class="dropdown-item" href="/account/"><?php if (isset($_SESSION['Username'])) {echo $_SESSION['Username'];}?></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/account/Reset.php">Reset password</a>
                            </li>
                            <hr class="dropdown-divider">
                            <li>
                                <a class="dropdown-item" href="/account/logout/">Log out</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <!--Products-->
                <li class="nav-item m-2 middle">
                    <a data-bs-toggle="tooltip" title="CTRL + P" data-bs-placement="bottom" class="nav-link<?php if (isset($PageName) && $PageName == "Products") { echo ' active'; }?>" href="/products/"><i class="far fa-rectangle-list"></i> Products</a>
                </li>
                <!--Contact us-->
                <li class="nav-item m-2 middle">
                    <a data-bs-toggle="tooltip" title="CTRL + C" data-bs-placement="bottom" class="nav-link<?php if (isset($PageName) && $PageName == "Contact") { echo ' active'; }?>" href="/contact/"><i class="fas fa-phone"></i> Contact us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
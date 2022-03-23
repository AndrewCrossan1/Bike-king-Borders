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
    <script src="/JS/base.js" rel="stylesheet"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b4c6b2d3ed.js" crossorigin="anonymous"></script>
    <!--Importing local javascript file-->
    <script src="/JS/base.js" rel="stylesheet"></script>
    <!--Importing local css file-->
    <link href="/CSS/base.css" rel="stylesheet"/>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bike King Borders</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav me-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == 'Index') { echo ' active'; }?>" href="/index.php"><i class="fas fa-house"></i> Home</a>
                </li>
                <!-- Products -->
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == "Products") { echo ' active'; }?>" href="/Products/products.php"><i class="far fa-rectangle-list"></i> Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == "Contact") { echo ' active'; }?>" href="/contact.php"><i class="fas fa-phone"></i> Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if (isset($PageName) && $PageName == "Gallery") { echo ' active'; }?>" href="/gallery.php"><i class="fas fa-photo-film"></i> Gallery</a>
                </li>
                <!-- Account Dropdown menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if (isset($PageName) && $PageName == "Account") { echo ' active'; }?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user"></i> Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if (!isset($_SESSION['loggedin'])) {?>
                            <li>
                                <a class="dropdown-item" href="/Account/login.php">Login</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/Account/create.php">Create an account</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">Forgot your password?</a>
                            </li>
                        <?php } else {?>
                            <li>
                                <a class="dropdown-item" href="/Account/account.php"><?php if (isset($_SESSION['Username'])) {echo $_SESSION['Username'];}?></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/Account/Reset.php">Reset password</a>
                            </li>
                            <hr class="dropdown-divider">
                            <li>
                                <a class="dropdown-item" href="/Account/logout.php">Log out</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>

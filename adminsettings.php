<?php

//Defining base directory
define("BASE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/");

//Scripts
include_once(BASE_DIR .'Scripts/database.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

//Models
include_once(BASE_DIR .'Models/Account.php');
include_once(BASE_DIR .'Models/Customer.php');
include_once(BASE_DIR .'Models/Category.php');
include_once(BASE_DIR .'Models/Product.php');
include_once(BASE_DIR .'Models/Basket.php');
include_once(BASE_DIR .'Models/Admin.php');
include_once(BASE_DIR .'Models/Offer.php');

include(BASE_DIR .'Scripts/adminheader.php');
?>

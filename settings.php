<?php

//Defining base directory
define("BASE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/");

//Scripts
include_once(BASE_DIR .'Scripts/database.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'functions.php');

//Models
include_once(BASE_DIR .'Models/Account.php');
include_once(BASE_DIR .'Models/Customer.php');
include_once(BASE_DIR .'Models/Category.php');

include(BASE_DIR .'Scripts/header.php');
?>
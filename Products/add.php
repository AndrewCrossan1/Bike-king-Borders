<?php
require($_SERVER['DOCUMENT_ROOT'] . "/Models/" . "Basket.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Models/" . "Product.php");
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'functions.php');

//Check if basket is set
if (!isset($_GET['id'])){
    ?>
    <script>
        setTimeout(function() {
            window.location.href = '/products/';
        });
    </script>
    <?php
} else {
    $db = new Database();
    $result = $db->Select("SELECT * FROM products WHERE ProductID = ?", array((int)$_GET['id']));
    $Product = $result->fetch_assoc();
    $NewProduct = new Product($Product['ProductID'], $Product['Name'], $Product['Description'], $Product['Price'], $Product['imgslug'], $Product['Colour'], $Product['Age'], $Product['Type']);
    $_SESSION['basket']->Add($NewProduct, 1);
    ?>
    <script>
        setTimeout(function() {
            window.location.href = '/products/';
        });
    </script>
    <?php
}
?>

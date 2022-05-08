<?php

if (!isset($_REQUEST['q'])) {
    ?>
    <script>
        window.location.href = "/home/";
    </script>
    <?php
}

require ($_SERVER['DOCUMENT_ROOT'] . "/Scripts/database.php");

//Get products
$Database = new Database();
$Products = $Database->Select("SELECT Name FROM products;");

while ($row = $Products->fetch_assoc()) {
    $a[] = $row['Name'];
}

$q = $_REQUEST['q'];

$name = "";

if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($a as $item) {
        if (str_contains(strtolower($item), $q)) {
            $name = $item;
        }
    }
}

echo $name === "" ? "No Product Found" : $name;

?>
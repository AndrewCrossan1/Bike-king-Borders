<?php
//Page Description: Contains data on the individual product which has been selected by the user
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = 'Product: ' . $_REQUEST['id'];

require($_SERVER['DOCUMENT_ROOT'] . '/settings.php');

if (isset($_REQUEST['id'])) {
    $Product = functions::GetProduct($_REQUEST['id']);
} else {
    ?>
    <script>
        window.location.href = "/products/"
    </script>
    <?php
}
?>

<body style="background-color: lightgrey;">
<div class="container-fluid">
    <div class="row bg-white p-3 light-shadow">
        <div class="col-md-3 mx-auto text-center justify-content-center align-items-center p-1">
            <?php echo $Product['Name'];?>
        </div>
        <div class="col-md-3 mx-auto text-center">
            <a href="#addtobasket" class="btn btn-primary">Add to basket</a>
        </div>
    </div>
    <div class="container-md bg-white my-5 rounded light-shadow h-75">
        hel
    </div>
</div>
</body>

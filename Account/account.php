<?php
session_start();

if (isset($_SESSION['Username'])) {
    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "My Account";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'settings.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'functions.php');
} else {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '/account/login/';
        });
    </script>
    <?php
}
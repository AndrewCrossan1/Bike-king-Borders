<?php
session_start();
//Page Description: Allows the user to view information on their account, also change it if they wish!
if (isset($_SESSION['Username'])) {
    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Account";

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "My Account";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require('../Scripts/header.php');
} else {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '/account/login/';
        });
    </script>
    <?php
}
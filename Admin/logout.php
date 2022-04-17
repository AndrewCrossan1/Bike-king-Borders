<?php
session_start();
//Page Description: Allows users to logout of their account

//Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
//Also keys is in with setting the pages active in header.php (Very fancy)
$PageName = "AdminLogout";

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Logout";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require('../Scripts/adminheader.php');

session_destroy();
$Message = base64_encode("Logged out successfully!");

if (!isset($_SESSION['Admin'])) {
    ?>
    <script>
        window.location.href = '/home/';
    </script>
<?php
}

?>
<script>
    setTimeout(function(){
        window.location.href = '/home/?message=<?php echo $Message; ?>';
    });
</script>
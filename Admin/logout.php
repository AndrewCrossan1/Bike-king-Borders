<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Logout";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

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
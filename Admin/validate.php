<?php
session_start();
//Include functions
$PageName = "AdminLogin";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

if (isset($_SESSION['Admin'])) {
    ?>
    <!--Redirect to admin home page-->
    <script>
        setTimeout(function() {
            window.location.href = '/admin/home/';
        });
    </script>
    <?php
} else {
    if (isset($_POST['submit'])) {
        if (AdminFunctions::Login($_POST['Username'], $_POST['Password'])) {
            //Set username
            $_SESSION['AdminUsername'] = $_POST['Username'];
            $_SESSION['Admin'] = true;
            //Retrieve user details
            $User = AdminFunctions::GetDetails($_SESSION['AdminUsername']);
            //Set message to be displayed to user upon logging in
            $Message = base64_encode("Welcome {$_POST['Username']}");
            ?>
            <script>
                setTimeout(function() {
                    window.location.href = '/admin/home/?message=<?php echo $Message; ?>';
                })
            </script>
            <?php
        } else {
            $Message = base64_encode("Invalid username or password");
            ?>
            <!--Redirect to admin login page with message saying invalid login-->
            <script>
                setTimeout(function() {
                    window.location.href = '/admin/login/?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Invalid Username or password");
        ?>
        <!--Redirect to admin login page with message saying invalid login-->
        <script>
            setTimeout(function() {
                window.location.href = '/admin/login/?message=<?php echo $Message; ?>';
            });
        </script>
        <?php
    }
}
?>

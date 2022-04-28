<?php

//Used for validating a users request to login.
session_start();

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'settings.php');

if (isset($_SESSION['Username'])) {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '/account/';
        });
    </script>
    <?php
} else {
    $PageName = "Accounts";
    if (isset($_POST['submit'])) {
        // TODO: Use regex for submission
        if (($_POST['Username']) == null || ($_POST['Password'] == null)) {
            $Message = base64_encode("Username or password incorrect");
            ?>
            <script>
                setTimeout(function(){
                    window.location.href = '/account/login/?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        } else {
            if(functions::Login(trim($_POST['Username']), trim($_POST['Password']))) {
                $Message = base64_encode("Welcome {$_POST['Username']}");
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = '/home/?message=<?php echo $Message; ?>';
                    });
                </script>
                <?php
            } else {
                $Message = base64_encode("Username or password incorrect");
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = '/account/login/?message=<?php echo $Message; ?>';
                    });
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            setTimeout(function(){
                window.location.href = '/home/';
            });
        </script>
        <?php
    }
}
?>
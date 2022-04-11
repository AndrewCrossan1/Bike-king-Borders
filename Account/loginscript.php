<?php

//Used for validating a users request to login.
session_start();
if (isset($_SESSION['Username'])) {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = 'account.php';
        });
    </script>
    <?php
} else {
    $PageName = "Accounts";
    require('../Scripts/functions.php');
    if (isset($_POST['submit'])) {
        // TODO: Use regex for submission
        if (($_POST['Username']) == null || ($_POST['Password'] == null)) {
            $Message = base64_encode("Username or password incorrect");
            ?>
            <script>
                setTimeout(function(){
                    window.location.href = 'login.php?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        } else {
            if(functions::Login(trim($_POST['Username']), trim($_POST['Password']))) {
                $Message = base64_encode("Welcome {$_POST['Username']}");
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = '../index.php?message=<?php echo $Message; ?>';
                    });
                </script>
                <?php
            } else {
                $Message = base64_encode("Username or password incorrect");
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'login.php?message=<?php echo $Message; ?>';
                    });
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            setTimeout(function(){
                window.location.href = 'index.php';
            });
        </script>
        <?php
    }
}
?>
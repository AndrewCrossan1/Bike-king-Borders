<?php
//Used for validating a users request to create a new account.
session_start();
//Require the header of the page (Includes Navigation, meta-data, etc.)

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
    include("../Scripts/functions.php");

    if (isset($_POST['submit'])) {
        if (functions::CreateAccount($_POST['UsernameInput'], $_POST['PasswordInput'], $_POST['PasswordInputConfirm'], $_POST['ForenameInput'], $_POST['SurnameInput'], $_POST['EmailInput'], $_POST['PhoneInput'], $_POST['HouseInput'], $_POST['AddressInput'])) {
            $Message = base64_encode("Account Created! Welcome {$_POST['UsernameInput']}");
            ?>
            <script>
                setTimeout(function(){
                    window.location.href = '/home/?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        } else {
            $Message = base64_encode("Account could not be created, try again later!");
            ?>
            <script>
                setTimeout(function(){
                    window.location.href = '/account/create/?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Account could not be created, try again later!");
        ?>
        <script>
            setTimeout(function(){
                window.location.href = '/account/create/?message=<?php echo $Message; ?>';
            });
        </script>
        <?php
    }
}?>
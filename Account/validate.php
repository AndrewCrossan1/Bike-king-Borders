<?php
//Used for validating a users request to create a new account.

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
    include("../Scripts/functions.php");

    if (isset($_POST['submit'])) {
        if (functions::CreateAccount($_POST['UsernameInput'], $_POST['PasswordInput'], $_POST['PasswordInputConfirm'], $_POST['ForenameInput'], $_POST['SurnameInput'], $_POST['EmailInput'], $_POST['PhoneInput'], $_POST['HouseInput'], $_POST['AddressInput'])) {
            $Message = base64_encode("Account Created! Welcome {$_POST['UsernameInput']}");
            ?>
            <script>
                setTimeout(function(){
                    window.location.href = '../index.php?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        } else {
            $Message = base64_encode("Account could not be created, try again later!");
            ?>
            <script>
                setTimeout(function(){
                    window.location.href = 'create.php?message=<?php echo $Message; ?>';
                });
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Account could not be created, try again later!");
        ?>
        <script>
            setTimeout(function(){
                window.location.href = 'create.php?message=<?php echo $Message; ?>';
            });
        </script>
        <?php
    }
}?>
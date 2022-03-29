<?php
$PageName = "Accounts";
    include("../Scripts/functions.php");
    if (isset($_POST['submit'])) {
        echo functions::CreateAccount($_POST['UsernameInput'], $_POST['PasswordInput'], $_POST['PasswordInputConfirm'], $_POST['ForenameInput'], $_POST['SurnameInput'], $_POST['EmailInput'], $_POST['PhoneInput'], $_POST['HouseInput'], $_POST['AddressInput']);
    }
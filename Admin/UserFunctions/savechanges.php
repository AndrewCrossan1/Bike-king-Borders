<?php

require($_SERVER['DOCUMENT_ROOT'] . '/Scripts/database.php');

if (isset($_POST['SaveChanges'])) {
    $Database = new Database();
    //Perform Update Join
    $query = $Database->conn->prepare("UPDATE accounts, customers SET Username = ?, Password = ?, Email = ? WHERE accounts.CustomerID = customers.CustomerID AND AccountID = ?");
    //Hash new password
    if ($_POST['Password'] != $_POST['PasswordHidden']) {
        $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    } else {
        $password = $_POST['PasswordHidden'];
    }
    $Message = base64_encode("Could not update account");
    $ID = (int)$_POST['HiddenID'];
    if ($query->bind_param('sssi', $_POST['Username'], $password, $_POST['Email'], $ID)) {
        if ($query->execute()) {
            $Message = base64_encode("Account updated");
            ?>
            <script>
                window.location.href = "https://localhost/admin/users/?message=<?php echo $Message; ?>";
            </script>
            <?php
            return;
        } else {
            ?>
            <script>
                window.location.href = "https://localhost/admin/users/?message=<?php echo $Message; ?>";
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            window.location.href = "https://localhost/admin/users/?message=<?php echo $Message; ?>";
        </script>
        <?php
    }
} else {
    ?>
    <script>
        window.location.href = "https://localhost/admin/users/";
    </script>
    <?php
}
?>
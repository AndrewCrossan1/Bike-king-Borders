<?php
session_start();

$PageName = "DeleteConfirm";
require('../../Scripts/functions.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}
if (isset($_POST['submitdelete'])) {
    $Database = new Database();
    if (!isset($_POST['ConfirmationInput'])) {
        $Message = base64_encode("Enter the code shown!");
        ?>
        <script>
            window.location.href = "/admin/products/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
    if ($_POST['ConfirmationInput'] == $_POST['ConfirmationNumber']) {
        $result = $Database->Delete("DELETE FROM products WHERE ProductID = ?", array($_POST['ProductID']));
        if ($result == true) {
            $Message = base64_encode("Product deleted successfully");
            ?>
            <script>
                window.location.href = "/admin/products/?message=<?php echo $Message;?>";
            </script>
            <?php
        } else {
            $Message = base64_encode("Product could not be deleted");
            ?>
            <script>
                window.location.href = "/admin/products/?message=<?php echo $Message;?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Please enter the code shown");
        ?>
        <script>
            window.location.href = "/admin/products/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
}
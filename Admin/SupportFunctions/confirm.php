<?php

session_start();

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'adminsettings.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}

if (isset($_POST['submitclose'])) {
    $Database = new Database();
    if (!isset($_POST['ConfirmationInput'])) {
        $Message = base64_encode("Enter the code shown!");
        ?>
        <script>
            window.location.href = "/admin/support/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
    if ($_POST['ConfirmationInput'] == $_POST['ConfirmationNumber']) {
        $result = $Database->Delete("UPDATE Tickets SET Active = 0 WHERE TicketID = ?", array($_POST['TicketID']));
        if ($result == true) {
            $Message = base64_encode("Ticket closed successfully");
            ?>
            <script>
                window.location.href = "/admin/support/?message=<?php echo $Message;?>";
            </script>
            <?php
        } else {
            $Message = base64_encode("Ticket could not be closed");
            ?>
            <script>
                window.location.href = "/admin/support/?message=<?php echo $Message;?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Please enter the code shown");
        ?>
        <script>
            window.location.href = "/admin/support/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
}
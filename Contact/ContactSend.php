<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/settings.php');

if (!isset($_REQUEST['ContactSubmit'])) {
    ?>
    <script>
        window.location.href = '/contact/';
    </script>
    <?php
}

//SQL Statement
$sql = "INSERT INTO Tickets (Subject, Message, Email, Fullname, DateCreated, ProductID) VALUES (?, ?, ?, ?, sysdate(), ?)";

//Create new database object
$Database = new Database();

//Get product from POST
$Product = $_REQUEST['Product'];
//Get the ProductID using the name of the bike
$ProductQuery = $Database->Select("SELECT ProductID FROM products WHERE Name = ?", array($Product));
//Bind result to variable
$ProductID = (int)$ProductQuery->fetch_assoc()['ProductID'];

//Insert
$Message = base64_encode("Ticket could not be created");
if ($query = $Database->conn->prepare($sql)) {
    if ($query->bind_param("ssssi", $_REQUEST['Subject'], $_REQUEST['Message'], $_REQUEST['Email'], $_REQUEST['FullName'], $ProductID)) {
        if ($query->execute()) {
            $Message = base64_encode("Support Ticket created");
        }
    }
}
?>
<script>
    window.location.href = '/Contact/?Message=<?php echo $Message;?>';
</script>


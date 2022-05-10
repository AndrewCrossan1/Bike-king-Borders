<?php

session_start();
//Require necessary
require ($_SERVER['DOCUMENT_ROOT'] . "/Scripts/database.php");

//Get products
$Database = new Database();

//Get submitted variables
$Status = $_REQUEST['status'];
$DatePosted = $_REQUEST['dateposted'];

//Set SQL statement
$sql = match ($Status) {
    'all' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID",
    'closed' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID AND Active = 0",
    'active' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID AND Active = 1",
};

//Append ordering to sql statement
$sql = match ($DatePosted) {
    'newest' => $sql . ' ORDER BY TicketID DESC;',
    'oldest' => $sql . ' ORDER BY TicketID ASC;',
};

$array = array();

$Tickets = $Database->Select($sql);
if ($Tickets == null) {
    $_SESSION['filteredcontent'] = null;
    ?>
    <script>
        window.location.href = '/admin/support/status=<?php echo $Status;?>/order=<?php echo $DatePosted;?>/';
    </script>
    <?php
} else {
    while ($result = $Tickets->fetch_assoc()) {
        array_push($array, $result);
    }
    $_SESSION['filteredcontent'] = $array;
    ?>
    <script>
        window.location.href = '/admin/support/status=<?php echo $Status;?>/order=<?php echo $DatePosted;?>/';
    </script>
    <?php
}
?>
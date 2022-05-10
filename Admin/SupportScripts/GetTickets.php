<?php
//Require necessary
require ($_SERVER['DOCUMENT_ROOT'] . "/Scripts/database.php");

//Get products
$Database = new Database();

//Get submitted variables
$Status = $_REQUEST['status'];
$DatePosted = $_REQUEST['dateposted'];

//Set SQL statement
$sql = match ($Status) {
    'All' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID",
    'Closed' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID AND Active = 0",
    'Active' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID AND Active = 1",
};

//Append ordering to sql statement
$sql = match ($DatePosted) {
    'Newest' => $sql . ' ORDER BY TicketID DESC;',
    'Oldest' => $sql . ' ORDER BY TicketID ASC;',
};

$array = array();

$Tickets = $Database->Select($sql);
if ($Tickets == null) {
    echo "No products found";
} else {
    while ($result = $Tickets->fetch_assoc()) {
        array_push($array, $result);
    }
    echo json_encode($array);
}
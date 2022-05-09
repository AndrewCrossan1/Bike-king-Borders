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
    'All' => "SELECT tickets.TicketID, tickets.Email, tickets.Fullname, tickets.Subject, tickets.Message, tickets.DateCreated, tickets.Active, products.ProductID, products.Name FROM tickets, products WHERE tickets.ProductID = products.ProductID",
    'Closed' => "SELECT tickets.TicketID, tickets.Email, tickets.Fullname, tickets.Subject, tickets.Message, tickets.DateCreated, tickets.Active, products.ProductID, products.Name FROM tickets, products WHERE tickets.ProductID = products.ProductID AND Active = 0",
    'Active' => "SELECT tickets.TicketID, tickets.Email, tickets.Fullname, tickets.Subject, tickets.Message, tickets.DateCreated, tickets.Active, products.ProductID, products.Name FROM tickets, products WHERE tickets.ProductID = products.ProductID AND Active = 1",
};

//Append ordering to sql statement
$sql = match ($DatePosted) {
    'Newest' => $sql . ' ORDER BY TicketID DESC;',
    'Oldest' => $sql . ' ORDER BY TicketID ASC;',
};

$array = array();

$Tickets = $Database->Select($sql);

while ($result = $Tickets->fetch_assoc()) {
    array_push($array, $result);
}
echo json_encode($array);
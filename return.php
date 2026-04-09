<?php
include 'db.php';

$rental_id = $_GET['rental_id'];

$result = $conn->query("SELECT * FROM rentals WHERE rental_id = $rental_id");

$conn->query("UPDATE maxhines 
             SET quantity = quantity + 1 
             WHERE machine_id = $machine_id");

echo "Machine returned successfully !.";
?>



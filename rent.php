<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$machine_id = $_GET['machine_id'];

$rental_date = date("Y-m-d");
$return_date = date("Y-m-d", strtotime("+7 days"));

$sql = "INSERT INTO rentals (user_id, machine_id, rental_date, return_date)
 VALUES ($user_id, $machine_id, '$rental_date', '$return_date')";

$conn->query($sql);

$conn->query("UPDATE machines 
             SET quantity = quantity - 1 
             WHERE machine_id = $machine_id");
echo "Machine rented successfully. Return by: " . $return_date;
?>
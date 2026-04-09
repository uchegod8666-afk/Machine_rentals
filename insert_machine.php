<?php
include 'db.php';

$machine_name = $_POST['machine_name'];
$serial_number = $_POST['serial_number'];
$Condition_status = $_POST['Condition_status'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO machines (machine_name, serial_number, Condition_status, quantity) VALUES ('$machine_name', '$serial_number', '$Condition_status', $quantity)";

if ($conn->query($sql)) {
    echo "New machine added successfully.";
} else {
    echo "Error";
}
?>
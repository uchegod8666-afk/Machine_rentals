<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_SESSION['user_id'];
    $machine_id = $_POST['machine_id'];
    $rental_date = $_POST["rent_date"];
    $return_date = $_POST["return_date"];

    $check = $db->query("SELECT quantity FROM machines WHERE machine_id = $machine_id");
    $machine = $check->fetch_assoc();

    if ($machine['quantity'] > 0) {

    $sql = "INSERT INTO rentals (user_id, machine_id, rental_date, return_date)
            VALUES ($user_id, $machine_id, '$rent_date', '$return_date')";

    if ($db->query($sql)) {
        $db->query("UPDATE machines SET quantity = quantity - 1 WHERE machine_id = $machine_id");
        echo "Rented Successfully"
    } else {
        echo "Error: " . $db->error;
    }
 } else {
     echo "Machine not available";
 }
}
 ?>


 



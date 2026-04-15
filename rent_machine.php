<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_SESSION['user_id']; // make sure user is logged in
    $machine_id = $_POST['machine_id'];
    $start_date = $_POST['rent_date'];
    $end_date = $_POST['return_date'];

    // Check machine availability
    $check = $db->query("SELECT quantity FROM machines WHERE machine_id = $machine_id");
    $machine = $check->fetch_assoc();

    if ($machine['quantity'] > 0) {

        // Insert rental
        $sql = "INSERT INTO rentals (user_id, machine_id, start_date, end_date)
                VALUES ('$user_id', '$machine_id', '$rent_date', '$return_date')";

        if ($db->query($sql)) {

            // Reduce quantity
            $db->query("UPDATE machines SET quantity = quantity - 1 WHERE machine_id = $machine_id");

            echo "✅ Machine rented successfully!";
        } else {
            echo "❌ Error: " . $db->error;
        }

    } else {
        echo "❌ Machine not available!";
    }
}
?>
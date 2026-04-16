<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }

    $user_id    = $_SESSION['user_id']; 
    $machine_id = $_POST['machine_id'];
    $rent_date  = $_POST['rent_date'];
    $return_date = $_POST['return_date'];

    $check = $db->query("SELECT quantity FROM machines WHERE machine_id = $machine_id");
    $machine = $check->fetch_assoc();

    if ($machine && $machine['quantity'] > 0) {

        $sql = "INSERT INTO rentals (machine_id, user_id, rent_date, return_date)
                VALUES ('$machine_id', '$user_id', '$rent_date', '$return_date')";

        if ($db->query($sql)) {

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
<br><br>
<a href="user_dashboard.php"
           class="text-red-600 font-medium hover:underline">
           Back to rental page
</a>

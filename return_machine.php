<?php
session_start();
include 'connection.php';


    $rental_id = $_GET['rental_id'];
    $tool_id = $_GET['machine_id'];

    $return_date = date("y-m-d");

    $sql = "UPDATE rentals SET return_date = ?, status = 'returned' WHERE rental_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $return_date, $rental_id);

    if ($stmt->execute()) {
        $updateSql = "UPDATE machines SET quantity = quantity + 1 WHERE machine_id = ?";
        $updateStmt = $db->prepare($updateSql);
        $updateStmt->bind_param("i", $tool_id);
        $updateStmt->execute();

        echo "Equipment returned successfully.";
        echo '<br><a href="user_dashboard.php">Back to Rental History</a>';
    } else {
        echo "Return failed.";
    }
?>
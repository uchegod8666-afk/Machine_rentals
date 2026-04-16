<?php
session_start();
include '../connection.php';

$machineId = intval($_GET['id']);

$stmt = $db->prepare("DELETE FROM machines WHERE machine_id = ? LIMIT 1");
$stmt->bind_param("i", $machineId);
$stmt->execute();

 if ($stmt->execute()) {
        header("Location: equipments.php?success=1");
        exit();
    } else {
        $error = "Update failed. Please try again.";
    }
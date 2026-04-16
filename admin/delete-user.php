<?php
session_start();
include '../connection.php';

$userId = intval($_GET['id']);

$stmt = $db->prepare("DELETE FROM users WHERE user_id = ? LIMIT 1");
$stmt->bind_param("i", $userId);
$stmt->execute();

 if ($stmt->execute()) {
        header("Location: all_users.php?success=1");
        exit();
    } else {
        $error = "Update failed. Please try again.";
    }
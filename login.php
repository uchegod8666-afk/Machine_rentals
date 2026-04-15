<?php
session_start();
include 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
//  test here

$sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin/admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
    } else {
        echo "wrong password.";
    }
} else {
    echo "No user found.";
}
?>
    
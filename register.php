<?php
include 'connection.php';

$fullname = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $db->query($check);

if ($result->num_rows > 0) {
    echo "User already exists!";
}else {
    $sql = "INSERT INTO users (name, username, email, password, role)
           VALUES ('$fullname', '$username', '$email', '$hashed_password', '$role')";

    if ($db->query($sql) === TRUE) {
        echo "Sign Up successful ! <a href='index.html'>Login here</a>";
    } else {
        echo "Error:" .$db->error;
    }      
}
?>

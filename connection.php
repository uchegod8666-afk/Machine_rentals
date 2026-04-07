<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "127.0.0.1";
$username = "2428089";
$password = "Evelyn@8666";
$dbname = "machinerental";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
echo "Connected successfully";
?>

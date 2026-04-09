<?php 
session_start();
if ($-SESSION['role'] != 'admin') {
    die("Access denied. Admins only.");   
}
?>
<h2>Admin Dashboard</h2>

<a href="add_machine.php">Add New Machine</a><br>
<a href="view_machines.php">Manage Machine</a><br>
<a href="add_user.php">Add New User</a>

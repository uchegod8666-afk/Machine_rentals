<?php
session_start();
include 'connection.php';

$sql = "SELECT * FROM machines Where quantity > 0"; 
$result = $db->query($sql);
?>

<h2>Available Machines</h2>

<table border="1">
    <tr>
        <th>Machine Name</th>
        <th>Serial Number</th>
        <th>Condition Status</th>
        <th>Quantity</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['machine_name']; ?></td>
        <td><?php echo $row['serial_number']; ?></td>
        <td><?php echo $row['Condition_status']; ?></td>
        <td><?php echo $row['quantity']; ?></td>

        <td>
            <a href="rent_machine.php?machine_id=<?= $row['machine_id']; ?>">Rent</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php
session_start();
include 'connection.php';

$userId = $_SESSION['user_id'];

$sql = "SELECT rentals.*, machines.name, machines.serial_number, machines.condition_status, machines.quantity 
        FROM rentals 
        INNER JOIN machines ON rentals.machine_id = machines.machine_id 
        WHERE rentals.status = 'rented' 
        AND rentals.user_id = $userId";  

$result = $db->query($sql);
$datas = [];
while ($row = $result->fetch_assoc()) {
    $datas[] = $row;  
}
?>

<h2>Rented Machines</h2>

<table border="1">
    <tr>
        <th>Machine Name</th>
        <th>Serial Number</th>
        <th>Condition Status</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php if (empty($datas)): ?>
    <tr>
        <td colspan="5">No rented machines found.</td>
    </tr>
    <?php else: ?>
    <?php foreach ($datas as $row): ?>  <!-- use foreach over $datas, not $result -->

    <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['serial_number']; ?></td>
        <td><?= $row['condition_status']; ?></td>
        <td>1</td>
        <td>
            <form action="rent_machine.php" method="POST">

                <input type="hidden" name="machine_id" value="<?= $row['machine_id']; ?>">

                <input type="date" name="rental_date" required>
                <input type="date" name="return_date" required>

                <button type="submit">Rent</button>
            </form>
            <a href="return_machine.php?rental_id=<?= $row['rental_id'] ?>&machine_id=<?= $row['machine_id'] ?>">Return</a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>

<a href="user_dashboard.php">Dashboard</a>
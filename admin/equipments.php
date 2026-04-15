<?php
include '../connection.php';

$select = "SELECT * FROM machines";
$result = $db->query($select);      
$datas = [];

while ($row = $result->fetch_assoc()) {  
    $datas[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Serial Number</th>
                <th>Condition</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($datas as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['machine_id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['serial_number']) ?></td>
                <td><?= htmlspecialchars($row['condition_status']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
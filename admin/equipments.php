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
    <title>Manage Machines</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            🧼 Machine Inventory
        </h1>

        <a href="add_machine.php"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
           + Add Machine
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

        <table class="min-w-full text-sm text-left">

            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Machine Name</th>
                    <th class="px-6 py-4">Serial Number</th>
                    <th class="px-6 py-4">Condition</th>
                    <th class="px-6 py-4">Stock</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <?php foreach ($datas as $row): ?>
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-700">
                        <?= htmlspecialchars($row['machine_id']) ?>
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-800">
                        <?= htmlspecialchars($row['name']) ?>
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        <?= htmlspecialchars($row['serial_number']) ?>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-medium rounded-full
                            <?= $row['condition_status'] === 'Good' 
                                ? 'bg-green-100 text-green-700' 
                                : 'bg-yellow-100 text-yellow-700' ?>">
                            <?= htmlspecialchars($row['condition_status']) ?>
                        </span>
                    </td>

                    <td class="px-6 py-4 font-bold text-gray-800">
                        <?= htmlspecialchars($row['quantity']) ?>
                    </td>

                    <td class="px-6 py-4 text-center space-x-2">

                        <a href="edit_equipments.php?id=<?= $row['machine_id'] ?>"
                           class="inline-block bg-indigo-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-indigo-600 transition">
                           Edit
                        </a>

                        <a href="delete-equipment.php?id=<?= $row['machine_id'] ?>"
                           onclick="return confirm('Are you sure you want to delete this machine?');"
                           class="inline-block bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition">
                           Delete
                        </a>

                    </td>

                </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>

</div>
            <a href="admin_dashboard.php"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
               Back to Admin Dashboard
            </a>

</body>
</html>
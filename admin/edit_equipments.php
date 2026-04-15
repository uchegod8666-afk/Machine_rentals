<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$result = $db->query("SELECT * FROM machines");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tools</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Edit Equipments</h2>
            <p class="text-gray-500 mt-1">Manage and update the tools available in your rental inventory.</p>
        </div>

        <!-- Table Card -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Serial Number</th>
                            <th class="px-6 py-4">Condition</th>
                            <th class="px-6 py-4">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="hover:bg-gray-50 transition">
                           <td class="px-6 py-4 font-medium text-gray-800">
    <?= $row['machine_id']; ?>
</td>

<td class="px-6 py-4">
    <?= $row['machine_name']; ?>
</td>

<td class="px-6 py-4">
    <?= $row['serial_number']; ?>
</td>

<td class="px-6 py-4">
    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
        <?= $row['condition_status'] == 'available' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'; ?>">
        <?= ucfirst($row['condition_status']); ?>
    </span>
</td>

<td class="px-6 py-4 space-x-2">
    <a href="edit_tool.php?id=<?= $row['machine_id']; ?>" class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600">
        Edit
    </a>

    <a href="delete_tool.php?id=<?= $row['machine_id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600"
       onclick="return confirm('Delete this machine?');">
        Delete
    </a>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
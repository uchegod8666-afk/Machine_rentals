<?php
include '../connection.php';

$select = "SELECT * FROM users";
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
    <title>All Users</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen font-sans">

    <div class="bg-gradient-to-r from-blue-800 to-indigo-700 text-white p-6 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wide">⚙️ Machine Rental Admin</h1>
            <a href="admin_dashboard.php" class="bg-white text-blue-800 px-4 py-2 rounded-lg shadow hover:bg-gray-100 transition">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-10 px-4">

        <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-3xl p-8 border border-gray-200">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">👥 All Users</h2>

                <a href="#"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                    + Add User
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full rounded-xl overflow-hidden">

                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm uppercase tracking-wider">
                            <th class="py-4 px-6 text-left">ID</th>
                            <th class="py-4 px-6 text-left">Name</th>
                            <th class="py-4 px-6 text-left">Email</th>
                            <th class="py-4 px-6 text-left">Username</th>
                            <th class="py-4 px-6 text-left">Role</th>
                            <th class="py-4 px-6 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 text-sm">

                        <?php foreach ($datas as $row): ?>
                        <tr class="border-b hover:bg-blue-50 transition duration-200">

                            <td class="py-4 px-6 font-semibold text-gray-600">
                                #<?= htmlspecialchars($row['user_id']) ?>
                            </td>

                            <td class="py-4 px-6">
                                <?= htmlspecialchars($row['name']) ?>
                            </td>

                            <td class="py-4 px-6 text-blue-600">
                                <?= htmlspecialchars($row['email']) ?>
                            </td>

                            <td class="py-4 px-6">
                                <?= htmlspecialchars($row['username']) ?>
                            </td>

                            <td class="py-4 px-6">
                                <span class="px-4 py-1 rounded-full text-xs font-semibold
                                    <?= $row['role'] == 'admin'
                                        ? 'bg-red-100 text-red-600'
                                        : 'bg-green-100 text-green-600' ?>">
                                    <?= htmlspecialchars($row['role']) ?>
                                </span>
                            </td>

                             <td class="py-4 px-6 flex gap-x-4">
                                <a href="edit-user.php?id=<?= $row['user_id'];  ?>" class="bg-blue-600 text-white py-1 rounded-md px-2 text-sm font-medium">Edit</a>
                                <a href="delete-user.php?id=<?= $row['user_id'];  ?>" class="bg-red-600 text-white py-1 px-2 text-sm font-medium rounded-md">Delete</a>
                            </td>

                        </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</body>
</html>
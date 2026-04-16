<?php
session_start();
include 'connection.php';

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    
    $sql = "SELECT * FROM machines 
            WHERE quantity > 0 
            AND name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM machines WHERE quantity > 0";
}

$result = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Machines</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Industrial Cleaning Machines
    </h2>

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <table class="min-w-full text-sm text-left">
            <form method="GET" class="mb-6 flex gap-3">

                <input 
                    type="text" 
                    name="search"
                    value="<?= htmlspecialchars($search) ?>"
                    placeholder="Search machine name..."
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 outline-none"
                >

                <button 
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition"
    >
                    Search
                </button>

                <a href="available_machines.php"
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                   Reset
                </a>

            </form>
            
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-4">Machine Name</th>
                    <th class="px-6 py-4">Serial Number</th>
                    <th class="px-6 py-4">Condition</th>
                    <th class="px-6 py-4">Stock</th>
                    <th class="px-6 py-4">Rent</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-semibold text-gray-700">
                        <?php echo $row['name']; ?>
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        <?php echo $row['serial_number']; ?>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            <?php echo ($row['condition_status'] == 'Good') ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'; ?>">
                            <?php echo $row['condition_status']; ?>
                        </span>
                    </td>

                    <td class="px-6 py-4 font-bold text-gray-800">
                        <?php echo $row['quantity']; ?>
                    </td>

                    <td class="px-6 py-4">
                        <form action="rent_machine.php" method="POST" class="flex flex-col gap-2">

                            <input type="hidden" name="machine_id" value="<?= $row['machine_id']; ?>">

                            <input type="date" name="rent_date" required
                                class="border rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-blue-400 outline-none">

                            <input type="date" name="return_date" required
                                class="border rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-blue-400 outline-none">

                            <button type="submit"
                                class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                                Rent Machine
                            </button>
                        </form>
                    </td>

                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

    <div class="flex justify-between items-center mt-6">

        <a href="rented_items.php"
           class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
           View Rented Items
        </a>

        <a href="index.html"
           class="text-red-600 font-medium hover:underline">
           Logout
        </a>

    </div>

</div>

</body>
</html>
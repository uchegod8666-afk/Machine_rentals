<?php
include '../connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['machine_name'];
$serialNo = $_POST['serial_number'];
$status = $_POST['Condition_status'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO machines (name, serial_number, condition_status, quantity)
           VALUES ('$name', '$serialNo', '$status', '$quantity')";

    if ($db->query($sql) === TRUE) {
        echo "Equipment added successfully";
    } else {
        echo "Error:" .$db->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Machine</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-lg p-8 border border-gray-200">

        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">⚙️ Add New Machine</h1>
            <p class="text-sm text-gray-500">Register industrial cleaning equipment</p>
        </div>

        <form method="post" class="space-y-5">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Machine Name
                </label>
                <input type="text" name="machine_name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="e.g. Industrial Vacuum Cleaner">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Serial Number
                </label>
                <input type="text" name="serial_number" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter serial number">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Condition Status
                </label>
                <select name="Condition_status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="available">Available</option>
                    <option value="rented">Rented</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Quantity
                </label>
                <input type="number" name="quantity"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter quantity">
            </div>

            <button type="submit"
                class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition duration-200 shadow-md">
                ➕ Add Machine
            </button>

        </form>

    </div>

</body>
</html>
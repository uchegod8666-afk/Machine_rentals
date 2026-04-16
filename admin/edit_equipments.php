<?php
session_start();
include '../connection.php';

$machineId = intval($_GET['id']);

$stmt = $db->prepare("SELECT * FROM machines WHERE machine_id = ? LIMIT 1");
$stmt->bind_param("i", $machineId);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['machine_name'];
    $serial   = $_POST['serial_number'];
    $status   = $_POST['Condition_status'];
    $quantity = intval($_POST['quantity']);

    $updateSql  = "UPDATE machines SET name = ?, serial_number = ?, condition_status = ?, quantity = ? WHERE machine_id = ?";
    $updateStmt = $db->prepare($updateSql);
    $updateStmt->bind_param("sssii", $name, $serial, $status, $quantity, $machineId);

    if ($updateStmt->execute()) {
        header("Location: equipments.php?success=1");
        exit();
    } else {
        $error = "Update failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Machine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-lg p-8 border border-gray-200">

        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">⚙️ Edit Equipments</h1>
            <p class="text-sm text-gray-500">Edit the equipments from our system.</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="space-y-5">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Machine name</label>
                <input type="text" name="machine_name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="e.g. Industrial Vacuum Cleaner"
                    value="<?= htmlspecialchars($data['name']) ?>">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Serial number</label>
                <input type="text" name="serial_number" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter serial number"
                    value="<?= htmlspecialchars($data['serial_number']) ?>">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Condition status</label>
                <select name="Condition_status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="available" <?= $data['condition_status'] === 'available' ? 'selected' : '' ?>>Available</option>
                    <option value="rented"    <?= $data['condition_status'] === 'rented'    ? 'selected' : '' ?>>Rented</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity</label>
                <input type="number" name="quantity"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter quantity"
                    value="<?= htmlspecialchars($data['quantity']) ?>">
            </div>

            <button type="submit"
                class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition duration-200 shadow-md">
                Save changes
            </button>

        </form>

    </div>

</body>
</html>
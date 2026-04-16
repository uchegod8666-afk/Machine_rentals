<?php
session_start();
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }

    if (!isset($_POST['machine_id'], $_POST['rent_date'], $_POST['return_date'])) {
        die("Missing required fields.");
    }

    $machineId  = intval($_POST['machine_id']); 
    $rent_date   = $_POST['rent_date'];
    $return_date = $_POST['return_date'];
    $userId      = $_SESSION['user_id']; 

    $insertSql  = "INSERT INTO rentals (machine_id, users_id, rent_date, return_date) VALUES (?, ?, ?, ?)";
    $insertStmt = $db->prepare($insertSql);

    if (!$insertStmt) {
        die("Prepare failed: " . $db->error);
    }

    $insertStmt->bind_param("iiss", $machineId, $userId, $rent_date, $return_date);

    if ($insertStmt->execute()) {
        header("Location: user_dashboard.php?success=1");
        exit();
    } else {
        $error = "Insert failed: " . $insertStmt->error;
    }

    $insertStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Machine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8 border border-gray-200">

        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">🔧 Rent a Machine</h1>
            <p class="text-sm text-gray-500">Fill in the details to create a rental</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="space-y-5">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Machine ID</label>
                <input type="number" name="machine_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                    placeholder="Enter machine ID">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">User ID</label>
                <input type="number" name="user_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                    placeholder="Enter user ID">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Rent date</label>
                <input type="date" name="rent_date" required
                    value="<?= date('Y-m-d') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Return date</label>
                <input type="date" name="return_date" required
                    value="<?= date('Y-m-d', strtotime('+7 days')) ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition duration-200 shadow-md">
                Confirm rental
            </button>

        </form>

    </div>

</body>
</html>
<?php
include '../connection.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$userId = intval($_GET['id']);

$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 1");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['role'])) {
        $error = "All fields are required.";
    } else {

        $fullname = $_POST['fullname'];
        $email    = $_POST['email'];
        $username = $_POST['username'];
        $role     = $_POST['role'];

        $updateSql  = "UPDATE users SET name = ?, email = ?, username = ?, role = ? WHERE user_id = ?";
        $updateStmt = $db->prepare($updateSql);
        $updateStmt->bind_param("ssssi", $fullname, $email, $username, $role, $userId);

        if ($updateStmt->execute()) {
            header("Location: all_users.php?success=1");
            exit();
        } else {
            $error = "Update failed. Please try again.";
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center font-sans">

<div class="bg-white shadow-2xl rounded-2xl w-full max-w-lg p-8 border border-gray-200">

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800">⚙️ Update User</h1>
        <p class="text-sm text-gray-500">Edit user details</p>
    </div>

    <form method="post" class="space-y-5">

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Full Name
            </label>
            <input type="text" name="fullname" required 
                value="<?= htmlspecialchars($data['name'] ?? '') ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Email
            </label>
            <input type="email" name="email" required 
                value="<?= htmlspecialchars($data['email'] ?? '') ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Username
            </label>
            <input type="text" name="username" required 
                value="<?= htmlspecialchars($data['username'] ?? '') ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Role
            </label>
            <select name="role"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                <option value="user" <?= ($data['role'] ?? '') == 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= ($data['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>

            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition duration-200 shadow-md">
            Update User
        </button>

    </form>
</div>

<div class="absolute bottom-6">
    <a href="all_users.php"
       class="text-red-600 font-medium hover:underline">
       ← Back to users
    </a>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <nav class="bg-blue-900 text-white p-4 shadow-md">
        <h1 class="text-2xl font-bold">Machine Rental Admin</h1>
    </nav>

    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                Admin Dashboard
            </h2>

            <div class="grid gap-6 md:grid-cols-3">

                <a href="add_machine.php"
                   class="bg-blue-600 text-white p-6 rounded-xl shadow hover:bg-blue-700 transition text-center">
                    <h3 class="text-xl font-semibold">➕ Add Machine</h3>
                    <p class="text-sm mt-2">Register new equipment</p>
                </a>

                <a href="equipments.php"
                   class="bg-green-600 text-white p-6 rounded-xl shadow hover:bg-green-700 transition text-center">
                    <h3 class="text-xl font-semibold">📦 All Machines</h3>
                    <p class="text-sm mt-2">View available inventory</p>
                </a>

                <a href="all_users.php"
                   class="bg-purple-600 text-white p-6 rounded-xl shadow hover:bg-purple-700 transition text-center">
                    <h3 class="text-xl font-semibold">👥 All Users</h3>
                    <p class="text-sm mt-2">Manage registered users</p>
                </a>

            </div>

        </div>
        <br><br>
            <a href="index.html"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
               Logout
            </a>

    </div>

</body>
</html>
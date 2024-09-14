<?php
include('../../config/config.php'); // Use relative path for config

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $password, $role]);

    // Redirect to login page after successful registration
    header("Location: login.php");
    exit(); // Ensure no further code is executed after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Register</h1>
        <form action="" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-bold mb-2">Role</label>
                <select id="role" name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="customer">Customer</option>
                    <option value="admin" name="administartor">Admin</option>
                    <option value="stylist" name="staff">Stylist</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>

            <p class="mt-4 text-center text-gray-600">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Log in here</a></p>

        </form>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
</html>

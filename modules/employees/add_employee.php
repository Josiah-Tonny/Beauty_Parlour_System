<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert new employee
    $query = "INSERT INTO users (name, email, role, password) VALUES (:name, :email, :role, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'role' => $role,
        'password' => $password
    ]);

    header("Location: view_employees.php?status=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Add New Employee</h2>
        <form action="add_employee.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role" class="border border-gray-300 p-2 w-full rounded" required>
                    <option value="stylist">Stylist</option>
                    <option value="receptionist">Receptionist</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Employee</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

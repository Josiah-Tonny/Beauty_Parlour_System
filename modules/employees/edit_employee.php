<?php
require '../../config/config.php';
require '../../includes/auth.php';

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Fetch employee data
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $employee_id]);
    $employee = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Update employee details
        $query = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'id' => $employee_id
        ]);

        header("Location: view_employees.php?status=updated");
        exit;
    }
} else {
    header("Location: view_employees.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Edit Employee</h2>
        <form action="edit_employee.php?id=<?= htmlspecialchars($employee_id) ?>" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($employee['name']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($employee['email']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role" class="border border-gray-300 p-2 w-full rounded" required>
                    <option value="stylist" <?= $employee['role'] == 'stylist' ? 'selected' : '' ?>>Stylist</option>
                    <option value="receptionist" <?= $employee['role'] == 'receptionist' ? 'selected' : '' ?>>Receptionist</option>
                    <option value="admin" <?= $employee['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Employee</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

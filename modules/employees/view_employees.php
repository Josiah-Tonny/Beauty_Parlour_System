<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Fetch employees
$query = "SELECT * FROM users WHERE role != 'admin'";
$employees = $pdo->query($query)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Employees List</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['email']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['role']) ?></td>
                        <td class="border px-4 py-2">
                            <a href="edit_employee.php?id=<?= htmlspecialchars($employee['id']) ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                            <a href="delete_employee.php?id=<?= htmlspecialchars($employee['id']) ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_employee.php" class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Employee</a>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

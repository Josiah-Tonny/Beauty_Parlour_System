<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Fetch employees (stylists)
$query = "SELECT * FROM users WHERE role = 'stylist'";
$stmt = $pdo->query($query);
$employees = $stmt->fetchAll();
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
        <h2 class="text-2xl font-semibold mb-6">Our Stylists</h2>
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b border-gray-300">Name</th>
                    <th class="px-4 py-2 border-b border-gray-300">Email</th>
                    <th class="px-4 py-2 border-b border-gray-300">Phone</th>
                    <th class="px-4 py-2 border-b border-gray-300">Schedule</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['email']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['phone']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($employee['schedule']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

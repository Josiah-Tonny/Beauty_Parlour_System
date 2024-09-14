<?php
require '../../config/config.php';
require '../../includes/auth.php';

$services = $pdo->query("SELECT * FROM services")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Services</h2>
        <a href="add_service.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Service</a>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($service['name']) ?></td>
                        <td class="border px-4 py-2">$<?= htmlspecialchars($service['price']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($service['description']) ?></td>
                        <td class="border px-4 py-2">
                            <a href="edit_service.php?id=<?= $service['id'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <a href="delete_service.php?id=<?= $service['id'] ?>" class="text-red-500 hover:text-red-700 ml-4" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

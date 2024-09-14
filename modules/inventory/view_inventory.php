<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Fetch inventory items
$query = "SELECT * FROM inventory";
$stmt = $pdo->query($query);
$inventory = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Inventory List</h2>
        <a href="add_inventory.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Item</a>
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'success'): ?>
                <p class="text-green-500">Item added successfully!</p>
            <?php elseif ($_GET['status'] === 'updated'): ?>
                <p class="text-green-500">Item updated successfully!</p>
            <?php elseif ($_GET['status'] === 'deleted'): ?>
                <p class="text-red-500">Item deleted successfully!</p>
            <?php endif; ?>
        <?php endif; ?>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Item Name</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventory as $item): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($item['name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($item['quantity']) ?></td>
                        <td class="border px-4 py-2">$<?= htmlspecialchars($item['price']) ?></td>
                        <td class="border px-4 py-2">
                            <a href="edit_inventory.php?id=<?= htmlspecialchars($item['id']) ?>" class="text-blue-500 hover:underline">Edit</a>
                            <a href="delete_inventory.php?id=<?= htmlspecialchars($item['id']) ?>" class="text-red-500 hover:underline ml-4" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

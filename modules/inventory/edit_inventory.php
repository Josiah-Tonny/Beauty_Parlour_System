<?php
require '../../config/config.php';
require '../../includes/auth.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch inventory item
    $query = "SELECT * FROM inventory WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $item = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Update inventory item
    $query = "UPDATE inventory SET name = :name, quantity = :quantity, price = :price WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'quantity' => $quantity,
        'price' => $price
    ]);

    header("Location: view_inventory.php?status=updated");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Edit Inventory Item</h2>
        <form action="edit_inventory.php" method="POST" class="space-y-6">
            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
            <div>
                <label for="name" class="block text-gray-700">Item Name</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($item['name']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="quantity" class="block text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="price" class="block text-gray-700">Price</label>
                <input type="number" name="price" id="price" step="0.01" value="<?= htmlspecialchars($item['price']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Item</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

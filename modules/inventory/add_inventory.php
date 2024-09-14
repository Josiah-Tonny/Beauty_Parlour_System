<?php
require '../../config/config.php';
require '../../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Insert inventory item
    $query = "INSERT INTO inventory (name, quantity, price) VALUES (:name, :quantity, :price)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'name' => $name,
        'quantity' => $quantity,
        'price' => $price
    ]);

    header("Location: view_inventory.php?status=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Add Inventory Item</h2>
        <form action="add_inventory.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700">Item Name</label>
                <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="quantity" class="block text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="price" class="block text-gray-700">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Item</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

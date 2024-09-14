<?php
require '../../config/config.php';
require '../../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    $query = "INSERT INTO services (name, price, description) VALUES (:name, :price, :description)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'name' => $name,
        'price' => $price,
        'description' => $description
    ]);

    header("Location: view_services.php?status=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Add New Service</h2>
        <form action="" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700">Service Name</label>
                <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="price" class="block text-gray-700">Price</label>
                <input type="number" name="price" id="price" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="border border-gray-300 p-2 w-full rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Service</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

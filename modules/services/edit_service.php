<?php
require '../../config/config.php';
require '../../includes/auth.php';

$id = $_GET['id'];
$service = $pdo->query("SELECT * FROM services WHERE id = $id")->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    $query = "UPDATE services SET name = :name, price = :price, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'id' => $id
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
    <title>Edit Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Edit Service</h2>
        <form action="" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700">Service Name</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($service['name']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="price" class="block text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="<?= htmlspecialchars($service['price']) ?>" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="border border-gray-300 p-2 w-full rounded" required><?= htmlspecialchars($service['description']) ?></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Service</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

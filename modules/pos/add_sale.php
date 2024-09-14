<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Fetch services
$services = $pdo->query("SELECT * FROM services")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Add Sale</h2>
        <form action="add_sale.php" method="POST" class="space-y-6">
            <div>
                <label for="service" class="block text-gray-700">Service</label>
                <select name="service" class="border border-gray-300 p-2 w-full rounded" required>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>"><?= htmlspecialchars($service['name']) ?> - $<?= htmlspecialchars($service['price']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="amount" class="block text-gray-700">Amount</label>
                <input type="number" name="amount" step="0.01" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div>
                <label for="date" class="block text-gray-700">Sale Date</label>
                <input type="datetime-local" name="date" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Sale</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = $_POST['service'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Insert sale
    $query = "INSERT INTO sales (service_id, amount, sale_date) VALUES (:service_id, :amount, :sale_date)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'service_id' => $service_id,
        'amount' => $amount,
        'sale_date' => $date
    ]);

    header("Location: view_sales.php?status=success");
    exit;
}
?>

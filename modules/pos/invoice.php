<?php
require '../../config/config.php';
require '../../includes/auth.php';

$sale_id = $_GET['id'];

// Fetch sale details
$query = "SELECT s.*, ser.name AS service_name FROM sales s JOIN services ser ON s.service_id = ser.id WHERE s.id = :sale_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['sale_id' => $sale_id]);
$sale = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Invoice</h2>
        <div class="mb-6">
            <p><strong>Service:</strong> <?= htmlspecialchars($sale['service_name']) ?></p>
            <p><strong>Amount:</strong> $<?= htmlspecialchars($sale['amount']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($sale['sale_date']) ?></p>
        </div>
        <a href="view_sales.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Sales</a>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

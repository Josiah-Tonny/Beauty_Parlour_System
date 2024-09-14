<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Fetch sales
$query = "SELECT s.*, ser.name AS service_name FROM sales s JOIN services ser ON s.service_id = ser.id";
$sales = $pdo->query($query)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Sales List</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Service</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['service_name']) ?></td>
                        <td class="border px-4 py-2">$<?= htmlspecialchars($sale['amount']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['sale_date']) ?></td>
                        <td class="border px-4 py-2">
                            <a href="invoice.php?id=<?= $sale['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Invoice</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

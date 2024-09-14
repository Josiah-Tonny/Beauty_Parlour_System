<?php
require '../../config/config.php';
require '../../includes/auth.php';

// Fetch total number of appointments
$totalAppointments = $pdo->query("SELECT COUNT(*) as total FROM appointments")->fetchColumn();

// Fetch total sales
$totalSales = $pdo->query("SELECT SUM(price) as total FROM sales")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Reports</h2>
        <div class="space-y-6">
            <div>
                <h3 class="text-xl font-semibold">Total Appointments</h3>
                <p><?= htmlspecialchars($totalAppointments) ?></p>
            </div>
            <div>
                <h3 class="text-xl font-semibold">Total Sales</h3>
                <p>$<?= htmlspecialchars($totalSales) ?></p>
            </div>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

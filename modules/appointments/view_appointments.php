<?php
include('../../config/config.php');
include('../../includes/header.php');

$customer_id = $_SESSION['user_id'];

$sql = "SELECT a.*, s.name AS service_name, u.name AS stylist_name FROM appointments a
        JOIN services s ON a.service_id = s.id
        JOIN users u ON a.stylist_id = u.id
        WHERE a.customer_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$customer_id]);
$appointments = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">My Appointments</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Upcoming Appointments</h2>
            <?php if (empty($appointments)): ?>
                <p>No upcoming appointments.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($appointments as $appointment): ?>
                        <li class="mb-4">
                            <p>Service: <?php echo $appointment['service_name']; ?></p>
                            <p>Stylist: <?php echo $appointment['stylist_name']; ?></p>
                            <p>Date: <?php echo date('F j, Y, g:i a', strtotime($appointment['appointment_date'])); ?></p>
                            <p>Status: <?php echo ucfirst($appointment['status']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
</html>

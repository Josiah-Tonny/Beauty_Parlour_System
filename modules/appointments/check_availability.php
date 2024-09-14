<?php
include('../../config/config.php');
include('../../includes/header.php');

$service_id = $_GET['service_id'];
$appointment_date = $_GET['appointment_date'];

$sql = "SELECT * FROM appointments WHERE service_id = ? AND appointment_date = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$service_id, $appointment_date]);
$appointments = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Availability</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Available Appointments</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Appointments for Selected Date</h2>
            <?php if (empty($appointments)): ?>
                <p>No appointments found for the selected date.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($appointments as $appointment): ?>
                        <li class="mb-2"><?php echo "Service ID: {$appointment['service_id']}, Stylist ID: {$appointment['stylist_id']}, Status: {$appointment['status']}"; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
</html>

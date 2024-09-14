<?php
include('../../config/config.php');
include('../../includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $status = 'confirmed';

    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$status, $appointment_id]);

    echo "<p class='text-green-500'>Appointment confirmed successfully!</p>";
}

$appointments = $pdo->query("SELECT * FROM appointments WHERE status = 'pending'")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Appointment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Confirm Appointments</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Pending Appointments</h2>
            <form action="" method="POST">
                <?php if (empty($appointments)): ?>
                    <p>No pending appointments to confirm.</p>
                <?php else: ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <div class="mb-4">
                            <p>Appointment ID: <?php echo $appointment['id']; ?>, Service ID: <?php echo $appointment['service_id']; ?>, Customer ID: <?php echo $appointment['customer_id']; ?></p>
                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Confirm</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
</html>

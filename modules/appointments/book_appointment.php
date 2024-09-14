<?php
include('../../config/config.php');
include('../../includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $stylist_id = $_POST['stylist_id'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "INSERT INTO appointments (customer_id, service_id, stylist_id, appointment_date) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customer_id, $service_id, $stylist_id, $appointment_date]);

    echo "<p class='text-green-500'>Appointment booked successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Book an Appointment</h1>
        <form action="" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="service_id" class="block text-gray-700 font-bold mb-2">Service</label>
                <select id="service_id" name="service_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php
                    $services = $pdo->query("SELECT * FROM services")->fetchAll();
                    foreach ($services as $service) {
                        echo "<option value='{$service['id']}'>{$service['name']} - \${$service['price']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="stylist_id" class="block text-gray-700 font-bold mb-2">Stylist</label>
                <select id="stylist_id" name="stylist_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php
                    $stylists = $pdo->query("SELECT id, name FROM users WHERE role = 'stylist'")->fetchAll();
                    foreach ($stylists as $stylist) {
                        echo "<option value='{$stylist['id']}'>{$stylist['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="appointment_date" class="block text-gray-700 font-bold mb-2">Appointment Date & Time</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Book Appointment</button>
        </form>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
</html>

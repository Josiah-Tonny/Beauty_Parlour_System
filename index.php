<?php
include('config/config.php');
include('includes/auth.php');
include('includes/header.php'); // Include header

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-4xl font-bold mb-8 text-pink-600">Glamour Parlor Dashboard</h1>

        <?php if (isAdmin()): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="modules/services/add_service.php" class="bg-pink-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    <span class="text-lg font-semibold text-pink-700 hover:text-pink-900">Manage Services</span>
                </a>
                <a href="modules/employees/view_employees.php" class="bg-purple-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    <span class="text-lg font-semibold text-purple-700 hover:text-purple-900">Manage Employees</span>
                </a>
                <a href="modules/reports/reports.php" class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    <span class="text-lg font-semibold text-blue-700 hover:text-blue-900">View Reports</span>
                </a>
            </div>
        <?php elseif (isStylist()): ?>
            <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <a href="modules/appointments/view_appointments.php" class="text-lg font-semibold text-green-700 hover:text-green-900">View Appointments</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="modules/appointments/book_appointment.php" class="bg-indigo-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    <span class="text-lg font-semibold text-indigo-700 hover:text-indigo-900">Book Appointment</span>
                </a>
                <a href="modules/appointments/view_appointments.php" class="bg-teal-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                    <span class="text-lg font-semibold text-teal-700 hover:text-teal-900">View My Appointments</span>
                </a>
            </div>
        <?php endif; ?>

        <div class="mt-10 text-center">
            <a href="modules/auth/logout.php" class="inline-block bg-red-500 text-white px-6 py-3 rounded-full hover:bg-red-600 transition duration-300">Logout</a>
        </div>
    </div>

    <?php include('includes/footer.php'); // Include footer 
    ?>

</body>

</html>
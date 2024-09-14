<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Parlor Management</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="../path/to/your/custom/styles.css">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Beauty Parlor Management</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="../index.php" class="hover:text-blue-300">Home</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="../appointments/view_appointments.php" class="hover:text-blue-300">Appointments</a></li>
                        <li><a href="../services/view_services.php" class="hover:text-blue-300">Services</a></li>
                        <li><a href="../inventory/view_inventory.php" class="hover:text-blue-300">Inventory</a></li>
                        <li><a href="../sales/view_sales.php" class="hover:text-blue-300">Sales</a></li>
                        <li><a href="../reviews/view_reviews.php" class="hover:text-blue-300">Reviews</a></li>
                        <li>
                            <form action="../auth/logout.php" method="POST" class="inline">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Logout</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li><a href="../auth/login.php" class="hover:text-blue-300">Login</a></li>
                        <li><a href="../auth/register.php" class="hover:text-blue-300">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
    </main>
</body>
</html>

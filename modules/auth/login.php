<?php
session_start();
include('../../config/config.php'); 
include('../../includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../../index.php");
        exit();
    } else {
        $error_message = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('../../assets/images/parlour.jpeg');">
    <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg w-96 backdrop-blur-sm">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>
        <?php if (isset($error_message)): ?>
            <p class="text-red-500 text-sm mb-4"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400 bg-white bg-opacity-75">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400 bg-white bg-opacity-75">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">Login</button>
        </form>
    </div>
    <?php include('../../includes/footer.php'); ?>
</body>
</html>

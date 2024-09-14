<?php
require '../../config/config.php';
require '../../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_SESSION['user_id'];
    $feedback = $_POST['feedback'];
    
    // Insert feedback into the database
    $query = "INSERT INTO feedback (customer_id, feedback, created_at) VALUES (:customer_id, :feedback, NOW())";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'customer_id' => $customer_id,
        'feedback' => $feedback
    ]);

    header("Location: view_feedback.php?status=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg rounded">
        <h2 class="text-2xl font-semibold mb-6">Submit Your Feedback</h2>
        <form action="add_feedback.php" method="POST" class="space-y-6">
            <div>
                <label for="feedback" class="block text-gray-700">Your Feedback</label>
                <textarea name="feedback" rows="4" class="border border-gray-300 p-2 w-full rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit Feedback</button>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>

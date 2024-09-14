<?php
require '../../config/config.php';
require '../../includes/auth.php';

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Delete employee
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $employee_id]);

    header("Location: view_employees.php?status=deleted");
    exit;
}
?>

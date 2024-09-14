<?php
require '../../config/config.php';
require '../../includes/auth.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete inventory item
    $query = "DELETE FROM inventory WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    header("Location: view_inventory.php?status=deleted");
    exit;
}
?>

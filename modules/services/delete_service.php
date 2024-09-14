<?php
require '../../config/config.php';
require '../../includes/auth.php';

$id = $_GET['id'];

$query = "DELETE FROM services WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);

header("Location: view_services.php?status=deleted");
exit;
?>

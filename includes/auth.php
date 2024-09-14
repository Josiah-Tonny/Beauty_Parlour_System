<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: modules/auth/login.php");
    exit();
}

function isAdmin() {
    return $_SESSION['role'] == 'admin';
}

function isStylist() {
    return $_SESSION['role'] == 'stylist';
}

function isCustomer() {
    return $_SESSION['role'] == 'customer';
}
?>

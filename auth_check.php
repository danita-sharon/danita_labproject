<?php
session_start();

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit;
}

// Restrict role if required
if (isset($required_role)) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $required_role) {
        header("Location: unauthorized.php");
        exit;
    }
}
?>

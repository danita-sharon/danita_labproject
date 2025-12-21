<?php
session_start();
require "auth_check.php"; 

if (!isset($_SESSION['role'])) {
    header("Location: logout.php");
    exit;
}

$role = $_SESSION['role'];

switch ($role) {
    case "faculty":
        header("Location: facultydashboard.php");
        break;

    case "student":
        header("Location: studentdashboard.php");
        break;

    default:
        // Unknown role → logout as security measure
        header("Location: logout.php");
        break;
}

exit;

<?php
session_start();
include '../includes/config.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

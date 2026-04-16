<?php
session_start();
require_once '../includes/init.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

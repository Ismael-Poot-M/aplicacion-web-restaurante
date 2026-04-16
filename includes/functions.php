<?php
// Validar entrada de usuario
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Generar número de tarjeta de lealtad único
function generateCardNumber()
{
    return 'LOY-' . strtoupper(substr(md5(uniqid()), 0, 8));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

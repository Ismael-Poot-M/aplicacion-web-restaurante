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

// Verificar si el usuario está logueado
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Verificar rol de admin
function isAdmin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

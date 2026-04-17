<?php
session_start();

// Limpiar sesión
$_SESSION = [];
session_destroy();

// Borrar cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 22000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirigir con flag
header("Location: ../pages/index.php?logout=1");
exit;
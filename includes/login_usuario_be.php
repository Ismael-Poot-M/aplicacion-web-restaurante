<?php
session_start();
include 'config.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$validar_login = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$correo' AND passwords='$contrasena'"
);

if (mysqli_num_rows($validar_login) > 0) {

    $usuario = mysqli_fetch_assoc($validar_login);

    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['username'] = $usuario['username'];
    $_SESSION['correo'] = $usuario['email'];
    $_SESSION['role'] = $usuario['role'];
    $_SESSION['nombre'] = $usuario['nombre'];

    // Redirección por rol
    if ($usuario['role'] === 'admin') {
        header("Location: ../pages/admin_panel.php");
        exit;
    }

    if ($usuario['role'] === 'cliente') {
        header("Location: ../pages/cliente_panel.php");
        exit;
    }

    echo '<script>
        alert("Rol no reconocido.");
        window.location = "../pages/login.php";
    </script>';
    exit;

} else {
    echo '<script>
        alert("Credenciales incorrectas.");
        window.location = "../pages/login.php";
    </script>';
    exit;
}
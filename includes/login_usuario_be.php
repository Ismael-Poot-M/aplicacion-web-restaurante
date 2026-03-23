<?php
session_start();
include 'config.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Validar credenciales
$validar_login = mysqli_query($conn, "SELECT * FROM users WHERE email='$correo' AND passwords='$contrasena'");

if (mysqli_num_rows($validar_login) > 0) {
    $usuario = mysqli_fetch_assoc($validar_login);

    // Guardar variables de sesión
    $_SESSION['correo'] = $usuario['email'];
    $_SESSION['role'] = $usuario['role'];

    // Redirigir según el rol
    if ($usuario['role'] === 'admin') {
        header("Location: ../pages/admin_panel.php");
        exit;
    } elseif ($usuario['role'] === 'cliente') {
        header("Location: ../pages/cliente_panel.php");
        exit;
    } else {
        // En caso de que haya otro rol o error
        echo '
            <script>
                alert("Rol no reconocido. Contacte al administrador del sistema.");
                window.location = "../pages/login.php"; 
            </script>
        ';
        exit;
    }
} else {
    echo '
        <script>
            alert("El usuario ingresado no ha sido registrado o los datos son incorrectos.");
            window.location = "../pages/login.php"; 
        </script>
    ';
    exit;
}

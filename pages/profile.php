<?php
session_start();
require_once '../includes/init.php';
include '../includes/header.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'cliente') {
    header("Location: ../pages/login.php");
    exit;
}

// Obtener datos del usuario
$nombrec = $_SESSION['nombre'] ?? '';
$correo = $_SESSION['correo'] ?? '';
$foto = $_SESSION['foto'] ?? '';
$usuario = $_SESSION['username'] ?? '';
$telefono = $_SESSION['telefono'] ?? '';
$query = $conn->prepare("SELECT nombre, email, username, role, photo, phone FROM users WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/profile_style.css">
</head>

<body>
    <div class="profile-container">

        <div class="profile-header">
            <img src="<?php echo $foto; ?>" alt="Foto de perfil">
            <h2 class="profile-label"><?php echo $nombrec; ?></h2>
            <p class="profile-label"><?php echo $usuario; ?></p>
        </div>

        <form action="update_profile.php" method="POST" class="profile-info">

            <label class="from-label">Nombre</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo $nombrec; ?>">

            <label class="from-label">Correo</label>
            <input class="form-control" type="email" name="correo" value="<?php echo $correo; ?>">

            <label class="from-label">Teléfono</label>
            <input class="form-control" type="text" name="telefono" value="<?php echo $telefono; ?>">

            <button class="btn" type="submit">Actualizar Perfil</button>

        </form>

        <form action="change_password.php" method="POST">

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
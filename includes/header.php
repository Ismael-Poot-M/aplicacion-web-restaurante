<?php
require_once __DIR__ . '/init.php';

$role = $_SESSION['role'] ?? 'guest';
$username = $_SESSION['username'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Restaurante'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="shortcut icon" href="../assets/images/Letra.png" type="image/x-icon">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark header">
        <div class="container-fluid">

            <!-- LOGO -->
            <a class="navbar-brand" href="../pages/index.php">
                <img src="../assets/images/logo-nombre-horizontal-blanco.png" height="70">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- MENÚ IZQUIERDO -->
                <ul class="navbar-nav me-auto">

                    <?php if ($role === 'admin'): ?>

                        <li class="nav-item">
                            <a href="../pages/index.php" class="nav-link">Inicio</a>
                        </li>

                        <!-- 🔴 SOLO ADMIN -->
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/admin_panel.php">Panel Administrador</a>
                        </li>

                    <?php elseif ($role === 'cliente'): ?>

                        <!-- 🟢 CLIENTE -->
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/index.php">Inicio</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../pages/cliente_panel.php">Reservar Mesa</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../pages/loyalty.php">Tarjeta de Lealtad</a>
                        </li>

                    <?php else: ?>

                        <!-- ⚪ INVITADO -->
                        <li class="nav-item">
                            <a class="nav-link" href="#conocenos">Conócenos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#ubicacion">Ubicación</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#contactanos">Contáctanos</a>
                        </li>

                    <?php endif; ?>

                </ul>

                <!-- MENÚ DERECHO -->
                <ul class="navbar-nav">

                    <?php if ($role !== 'guest'): ?>

                        <li class="nav-item">
                            <span class="nav-link"><?= htmlspecialchars($username); ?>!</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#" onclick="confirmLogout(event)">
                                Cerrar Sesión
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="../pages/login.php">Iniciar Sesión</a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmLogout(e) {
            e.preventDefault();

            Swal.fire({
                title: "¿Deseas cerrar sesión?",
                text: "Los cambios no guardados se perderán.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, salir",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../includes/logout.php";
                }
            });
        }
    </script>
</body>

</html>
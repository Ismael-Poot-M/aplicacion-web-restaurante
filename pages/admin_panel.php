<?php
session_start();
include '../includes/config.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_menu.css">
    <link rel="shortcut icon" href="../assets/images/Letra.png" type="image/x-icon">
    <title>Menú Administrador</title>
</head>

<body>

    <div class="container text-center">
        <div class="row align-items-start">

            <div class="col">
                <a href="../pages/index.php"><img class="logo" src="../assets/images/logo-nombre-horizontal-blanco.png"></a>
            </div>

        </div>
    </div>

    <div class="container text-center">
        <div class="row align-items-start">

            <div class="col">
                <h2 class="titulo">Panel de Administración</h2>
            </div>

        </div>
    </div>

    <div class="container my-4">
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100">
                    <a href="reservations.php">
                        <img src="../assets/images/seccion_asignacion_mesas.jpg" class="card-img-top" alt="Mapeo de Restaurante">
                        <h4 class="texto_superior text-center mt-2">Mapeo de Restaurante</h4>
                    </a>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100">
                    <a href="admin_reservations.php">
                        <img src="../assets/images/seccion_reservacion.jpg" class="card-img-top" alt="Reservaciones">
                        <h4 class="texto_superior text-center mt-2">Reservaciones</h4>
                    </a>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100">
                    <a href="events.php">
                        <img src="../assets/images/seccion_eventos.jpg" class="card-img-top" alt="Eventos">
                        <h4 class="texto_superior text-center mt-2">Eventos</h4>
                    </a>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100">
                    <a href="loyalty.php">
                        <img src="../assets/images/seccion_tdl.jpg" class="card-img-top" alt="Tarjetas de Lealtad">
                        <h4 class="texto_superior text-center mt-2">Tarjetas de Lealtad</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
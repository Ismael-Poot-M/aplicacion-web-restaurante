<?php
session_start();

require_once '../includes/init.php';
include '../includes/header.php';

// Validar sesión y rol
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'cliente') {
    header("Location: ../pages/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener reservaciones del usuario
$stmt = $conn->prepare("
    SELECT table_number, num_people, reservation_date, reservation_time, 
           client_name, phone, email, occasion, special_request 
    FROM reservations 
    WHERE user_id = ?
    ORDER BY reservation_date DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Obtener foto del usuario (opcional)
$query = $conn->prepare("SELECT photo FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$user_result = $query->get_result();
$user = $user_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservaciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reservation_client.css">
</head>

<body>

<div class="container mt-5">

    <h2 class="text-center mb-4 titulo">Mis Reservaciones</h2>

    <div class="row">

        <?php if ($result->num_rows > 0): ?>

            <?php $i = 0; ?>
            <?php while ($reserv = $result->fetch_assoc()): 
                $modal_id = "modal_" . $i;
            ?>

            <div class="col-md-2 mb-4">

                <div class="card shadow-sm" style="cursor:pointer;"
                     data-bs-toggle="modal" 
                     data-bs-target="#<?= $modal_id ?>">

                    <div class="card-body text-center">
                        <h5 class="card-title">
                            Mesa <?= $reserv['table_number'] ?>
                        </h5>

                        <p class="card-text">
                            <?= $reserv['reservation_date'] ?>
                        </p>

                        <p class="card-text">
                            <?= $reserv['reservation_time'] ?>
                        </p>
                    </div>

                </div>

            </div>

            <!-- MODAL -->
            <div class="modal fade" id="<?= $modal_id ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Detalles de la reservación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p><strong>Mesa:</strong> <?= $reserv['table_number'] ?></p>
                            <p><strong>Personas:</strong> <?= $reserv['num_people'] ?></p>
                            <p><strong>Fecha:</strong> <?= $reserv['reservation_date'] ?></p>
                            <p><strong>Hora:</strong> <?= $reserv['reservation_time'] ?></p>
                            <p><strong>Nombre:</strong> <?= $reserv['client_name'] ?></p>
                            <p><strong>Teléfono:</strong> <?= $reserv['phone'] ?></p>
                            <p><strong>Email:</strong> <?= $reserv['email'] ?></p>
                            <p><strong>Ocasión:</strong> <?= $reserv['occasion'] ?></p>
                            <p><strong>Solicitud:</strong> <?= $reserv['special_request'] ?></p>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger">Cancelar</button>
                            <button class="btn btn-success">Editar</button>
                        </div>

                    </div>
                </div>
            </div>

            <?php $i++; ?>
            <?php endwhile; ?>

        <?php else: ?>

            <p class="text-center">No tienes reservaciones.</p>

        <?php endif; ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
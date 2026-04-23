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
$nombrec = $_SESSION['nombre'] ?? 'Usuario';
$foto = $_SESSION['foto'] ?? '';


// Obtener tarjeta
$stmt = $conn->prepare("SELECT card_number, stamps FROM loyalty_cards WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$card = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TDL - <?php echo $nombrec; ?></title>
    <link rel="stylesheet" href="../assets/css/loyalty_style.css">
</head>

<body>

    <h1 class="title">TARJETAS DE LEALTAD</h1>

    <div class="card-container">

        <?php if ($card): ?>
            <div class="loyalty-card" onclick="openCard()">

                <img src="../assets/images/logo-nombre-horizontal-blanco.png" class="card-bg">

                <div class="card-info">
                    <h3><?= $card['card_number'] ?></h3>
                    <p><?= $_SESSION['nombre'] ?></p>
                </div>

            </div>
        <?php else: ?>
            <p>No tienes tarjeta</p>
        <?php endif; ?>

    </div>

    <!-- MODAL -->
    <div id="cardModal" class="modal">

        <div class="modal-content">

            <h2>Tarjeta de Lealtad</h2>

            <!-- TARJETA -->
            <div class="card-preview">
                <img src="<?php echo $foto; ?>">
                <p ><?= $_SESSION['nombre'] ?></p>
            </div>

            <!-- SELLOS -->
            <h3>Sellos Actuales</h3>

            <div class="stamps-grid">
                <?php
                $max = 7;
                $stamps = $card['stamps'] ?? 0;

                for ($i = 1; $i <= $max; $i++):
                ?>
                    <img
                        src="../assets/images/<?= $i <= $stamps ? 'burger_fill.png' : 'burger_empty.png' ?>"
                        class="stamp">
                <?php endfor; ?>
            </div>

            <button class="btn" onclick="closeCard()">Cerrar</button>

        </div>

    </div>


<script src="../assets/js/script_loyalty.js"></script>
</body>

</html>
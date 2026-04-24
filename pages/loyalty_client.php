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
$usuario = $_SESSION['username'] ?? '';
$nombrec = $_SESSION['nombre'] ?? 'Usuario';
$foto = $_SESSION['foto'] ?? '';

// Obtener tarjeta
$stmt = $conn->prepare("SELECT card_number, qr_code, stamps FROM loyalty_cards WHERE user_id = ?");
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

    <div class="tdl">

        <div data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-delay="300">

            <h2 class="titulo-bienvenida">
                Tarjeta de Lealtad del cliente <?php echo $usuario; ?><br> Sellos actuales
                
            </h2>

        </div>

        <?php if ($card): ?>

            <div class="top-section">
                <div class="container_card">
                    <div class="card-container_2" data-aos="flip-left" data-aos-duration="2000">
                        <div class="card <?php for ($i = 1; $i <= 7; $i++) {
                                                if ($card['stamps'] == $i) echo "activeDay_$i";
                                            } ?>">

                            <div class="card-front">
                                <div class="card-front-image"></div>

                                <div class="card-content">
                                    <img class="logo_tdl" src="../assets/images/logo-nombre-horizontal-blanco.png">
                                    <h4>Tarjeta de Lealtad</h4>
                                    <h4><?php echo $usuario; ?></h4>
                                </div>
                            </div>

                            <div class="card-back">
                                <div class="card-content-back">
                                    <h1>Sellos: <?= $card['stamps'] ?>/7</h1>
                                    <h2><?= $card['card_number'] ?></h2>
                                    <p>Cliente frecuente</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="seccion-2">

                    <div class="dias_visitados">

                        <div class="marcador_dias_2 <?php for ($i = 1; $i <= 7; $i++) {
                                                        if ($card['stamps'] == $i) echo "activeDay_$i";
                                                    } ?>" data-aos="zoom-in-down">

                            <?php
                            $max = 7;
                            $stamps = $card['stamps'];

                            for ($i = 1; $i <= $max; $i++):
                            ?>
                                <img
                                    src="../assets/images/<?= $i <= $stamps ? 'burger1.png' : 'burger2.png' ?>"
                                    class="img_asistencia">
                            <?php endfor; ?>

                        </div>

                    </div>

                </div>

            </div>
            <div class="info_declaracion" data-aos="fade-up">
                <h2>¡Nos encanta que seas nuestro cliente!</h2>

                <h3>
                    Cada visita suma un sello. Completa tu tarjeta y obtén recompensas.
                </h3>

            </div>
    </div>

    <!-- RECOMPENSAS -->
    <div class="titulo_recompensas_C" data-aos="fade-up">
        <h1>GANA ESTAS RECOMPENSAS</h1>
    </div>

    <div class="division_dias">

        <?php
            $rewards = [
                1 => ["burger.png", "Hamburguesa BBQ"],
                2 => ["vino.png", "Copa de vino"],
                3 => ["hojaldra.png", "Postre especial"],
                4 => ["descuento.png", "20% descuento"],
                5 => ["taco.png", "Tacos"],
                6 => ["bañera.png", "Bebida premium"],
                7 => ["regalo.png", "Recompensa sorpresa"]
            ];

            for ($i = 1; $i <= 7; $i++):
        ?>

            <div class="div-<?= $i ?> <?= $card['stamps'] >= $i ? 'active' : '' ?>" data-aos="zoom-in-down">

                <h1>DÍA <?= $i ?></h1>

                <?php if ($card['stamps'] >= $i): ?>

                    <h3>Te regalamos:</h3>

                    <img src="../assets/images/<?= $rewards[$i][0] ?>" class="img-regalos">

                    <h2><?= $rewards[$i][1] ?></h2>

                <?php else: ?>

                    <div class="img-cover">
                        
                        <img src="../assets/images/regalo.png" class="oculto">
                        
                    </div>

                <?php endif; ?>

            </div>

        <?php endfor; ?>

    </div>

<?php else: ?>

    <p class="notargeta">No tienes tarjeta de lealtad</p>

<?php endif; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>

</html>
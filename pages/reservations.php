<?php
session_start();
require_once '../includes/init.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

// Obtener mesas y muebles
$mesas = $conn->query("SELECT * FROM tables");
$muebles = $conn->query("SELECT * FROM furniture");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Administrador</title>

    <!-- style css -->
    <link rel="shortcut icon" href="../assets/images/Letra.png" type="image/x-icon">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/reservation_style.css">
</head>

<body>

    <div class="container">

        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col">
                    <a href="admin_panel.php"><img class="volver" src="../assets/images/retroceso.png"></a>
                </div>
                <div class="col">
                    <h2 class="titulo">Mapa del Restaurante</h2>
                </div>
                <div class="col">

                </div>
            </div>
        </div>


        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col">
                    <button class="btn btn-primary boton">Agregar Mesa</button>
                </div>
                <div class="col">
                    <button id="guardarPosiciones" class="btn btn-primary boton">Guardar</button>
                </div>
                <div class="col">
                    <button class="btn btn-primary boton">Agregar Objeto</button>
                </div>
            </div>
        </div>

        <div id="mapa">
            <!-- Mesas -->
            <?php while ($mesa = $mesas->fetch_assoc()): ?>
                <?php
                $status = strtolower(trim($mesa['status']));
                $capacity = intval($mesa['capacity']);

                // Definir color del número según estado
                if ($status === 'disponible') {
                    $colorNumero = '#00ff11';
                } elseif ($status === 'ocupada') {
                    $colorNumero = '#ff0000';
                } elseif ($status === 'reservada') {
                    $colorNumero = '#fab712';
                } else {
                    $colorNumero = 'white';
                }

                // Determinar imagen según capacidad y estado
                $imgMesa = "../assets/images/mapeo_restaurante/mesa_{$capacity}_";

                switch ($status) {
                    case 'disponible':
                        $imgMesa .= "verde.png";
                        break;
                    case 'ocupada':
                        $imgMesa .= "roja.png";
                        break;
                    case 'reservada':
                        $imgMesa .= "naranja.png";
                        break;
                    default:
                        $imgMesa .= "verde.png";
                }
                ?>
                <div class="objeto mesa" data-id="<?php echo $mesa['id']; ?>" data-type="mesa"
                    style="left:<?php echo $mesa['pos_x']; ?>px; top:<?php echo $mesa['pos_y']; ?>px;">
                    <img src="<?php echo $imgMesa; ?>"
                        alt="Mesa <?php echo $mesa['table_number']; ?>"
                        style="width:80px; height:80px;">
                    <div class="labelNumero" style="color:<?php echo $colorNumero; ?>;">
                        <?php echo $mesa['table_number']; ?>
                    </div>
                </div>
            <?php endwhile; ?>


            <!-- MUEBLES -->
            <?php while ($mueble = $muebles->fetch_assoc()): ?>
                <div class="objeto resizable" data-id="<?php echo $mueble['id']; ?>" data-type="mueble"
                    style="left:<?php echo $mueble['pos_x']; ?>px; top:<?php echo $mueble['pos_y']; ?>px;">
                    <img src="<?php echo $mueble['imagen']; ?>"
                        alt="<?php echo $mueble['nombre']; ?>"
                        style="width:<?php echo intval($mueble['width']); ?>px; height:<?php echo intval($mueble['height']); ?>px;">

                </div>
            <?php endwhile; ?>
        </div>
    </div>


    <!-- script js -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/scriptsweet.js"></script>
</body>

</html>
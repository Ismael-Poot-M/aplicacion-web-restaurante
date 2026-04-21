<?php
session_start();
require_once '../includes/init.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'cliente') {
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
    <title>Mapa Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/reservation_client_style.css">
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

        <div id="mapa">
            <!-- Mesas -->
            <?php while ($mesa = $mesas->fetch_assoc()): ?>
                <?php
                $status = strtolower(trim($mesa['status']));
                $capacity = intval($mesa['capacity']);

                if ($status === 'disponible') {
                    $colorNumero = '#00ff11';
                } elseif ($status === 'ocupada') {
                    $colorNumero = '#ff0000';
                } elseif ($status === 'reservada') {
                    $colorNumero = '#fab712';
                } else {
                    $colorNumero = 'white';
                }

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

                // 🔥 ID único
                $modalId = "modalMesa_" . $mesa['id'];
                ?>

                <!-- MESA -->
                <div class="objeto mesa"
                    data-id="<?php echo $mesa['id']; ?>"
                    data-type="mesa"
                    style="left:<?php echo $mesa['pos_x']; ?>px; top:<?php echo $mesa['pos_y']; ?>px;"
                    data-bs-toggle="modal"
                    data-bs-target="#<?php echo $modalId; ?>">

                    <img src="<?php echo $imgMesa; ?>"
                        alt="Mesa <?php echo $mesa['table_number']; ?>"
                        style="width:80px; height:80px;">

                    <div class="labelNumero" style="color:<?php echo $colorNumero; ?>;">
                        <?php echo $mesa['table_number']; ?>
                    </div>
                </div>

                <!-- MODAL (MISMO QUE TENÍAS, SOLO CAMBIA EL ID) -->
                <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <div class="row">
                                <div class="col">
                                    <form action="#" method="POST" enctype="multipart/form-data">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 informacion">
                                                Reservar Mesa #<?php echo $mesa['id']; ?>
                                            </h1>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <label class="from-label">Número de Mesa</label>
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $mesa['table_number']; ?>" disabled>
                                                </div>
                                                <div class="col">
                                                    <label class="from-label">Número de Personas</label>
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $mesa['capacity']; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="from-label">Nombre Completo</label>
                                                <input class="form-control" type="text" name="nombre">
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <label class="from-label">Fecha</label>
                                                    <input class="form-control" type="text" name="fecha_reserva">
                                                </div>
                                                <div class="col">
                                                    <label class="from-label">Teléfono</label>
                                                    <input class="form-control" type="text" name="telefono">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="from-label">Correo Electrónico</label>
                                                <input class="form-control" type="text" name="correo">
                                            </div>

                                            <div class="mb-3">
                                                <label class="from-label"></label>
                                                <select name="ocasion_especial" class="form-control">
                                                    <option value="">Seleccione una ocasion (opcional)</option>
                                                    <option value="cumpleaños">Cumpleaños</option>
                                                    <option value="aniversario">Aniversario</option>
                                                    <option value="fiesta">Fiesta</option>
                                                    <option value="otra">Otra</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <label class="from-label">Solicitud especial</label>
                                                    <input class="form-control" type="text" name="solicitud_especial">
                                                </div>
                                                <div class="col">
                                                    <label class="from-label">Hora</label>
                                                    <input class="form-control" type="text" name="hora">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Completar Reservación
                                            </button>
                                        </div>

                                    </form>
                                </div>

                                <!-- 🔥 TU COLUMNA SE RESPETA COMPLETAMENTE -->
                                <div class="col">
                                    <div class="modal-header">
                                        <h2 class="informacion">¿Qué debes saber antes de ir?</h2>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="informacion">Información importante para comensales</h4>
                                        <p class="body-informacion">
                                            Ofrecemos un periodo de gracia de 15 minutos. Llamanos si vas a llegar con mas de 15 minutos de atraso después de tu hora de reservación.
                                        </p>
                                        <p class="body-informacion">
                                            Es posible que te contactemos por esta reservación. Por favor, manten tu correo electronico y número de telefono actualizados.
                                        </p>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="informacion">Una nota del restaurante</h4>
                                        <p class="body-informacion">Aceptamos mascotas en nuestra terraza de 1 a 5 pm</p>
                                    </div>
                                </div>

                            </div>

                        </div>
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
<?php
require_once '../includes/init.php';
include '../includes/header.php';

// Obtener evento del mes
$result = $conn->query("SELECT * FROM events ORDER BY date DESC LIMIT 1");
$event = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/Letra.png" type="image/x-icon">

</head>

<body>
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/images/header_principal.png" class="d-block w-100" alt="Slide 1">
                <img src="../assets/images/logo-nombre-horizontal-blanco.png" class="imagen-superior">
            </div>
        </div>
    </div>

    <!-- Evento del Mes -->
    <section class="container my-5">

        <div class="row align-items-center">
            <div class="col-sm-6 col-md-4 texto">
                <img src="../assets/images/lobo.png" class="lobo">
                <h1>Evento del Mes</h1>
                <h5>Aqui encontrarás el evento destacado del mes, pensado para ofrecerte momentos únicos llenos de sabor, ambiente y diversión. Mantente atento y ven a disfrutar con nosotros cada nueva celebración.</h5>
            </div>
            <div class="col-sm-6 col-md-8 texto">
                <?php if ($event): ?>
                    <div class="card">
                        <div class="card-body">
                            <h3><?php echo $event['title']; ?></h3>
                            <h3><?php echo $event['date']; ?></h3>
                            <p><?php echo $event['description']; ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No hay eventos disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
    </div>

    <!-- Información del Restaurante -->
    <section class="container my-5" id="conocenos">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8 texto">
                <img src="../assets/images/nosotros.png" class="nosotros">
            </div>
            <div class="col-sm-6 col-md-4 texto">
                <img src="../assets/images/lobo.png" class="lobo">
                <h1>Nosotros</h1>
                <h5>Nuestro bar-restaurante es un espacio pensado para disfrutar de una experiencia gastronómica única, combinando el mejor ambiente con una amplia variedad de platillos y bebidas. Contamos con un menú que fusiona sabores tradicionales con toques modernos, ideal para todo tipo de paladares.</h5>
            </div>
        </div>
    </section>

    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
    </div>

    <!-- Visión -->
    <section class="container my-5">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-4 texto">
                <img src="../assets/images/lobo.png" class="lobo">
                <h1>Nuestra idea</h1>
                <h5>Nuestro bar-restaurante nace de la pasión por la buena comida, la mixología y los momentos que se disfrutan al máximo. Inspirados en la energía y el espíritu alegre de nuestra ciudad, decidimos crear un espacio donde cada visita se convierta en una experiencia memorable.</h5>
            </div>
            <div class="col-sm-6 col-md-8 texto">
                <img src="../assets/images/idea.png" class="idea">
            </div>
        </div>
    </section>

    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
    </div>

    <!-- Tarjeta de Lealtad -->
    <section class="container my-5">

        <div class="row align-items-center">

            <div class="col-sm-6 col-md-12 texto titulo">
                <h1>Gana Increibles Recompensas</h1>
            </div>

        </div>

        <div class="row align-items-center">

            <div class="col-sm-6 col-md-5 texto">
                <h1>Nuestra Tarjeta de Lealtad</h1>
                <h5>Nuestro programa de recompensas te ofrece beneficios exclusivos diseñados especialmente para ti.</h5>
            </div>
            <div class="col-sm-6 col-md-7 texto">
                <img src="../assets/images/TDL.png" class="TDL">
            </div>

        </div>

        <div class="row align-items-center titulo">

            <div class="col-sm-6 col-md-12 texto">
                <h4>¡Regístrate e inicia sesión ahora mismo para comenzar a disfrutar de todas las ventajas que te esperan en nuestro programa de recompensas! Te garantizamos que cada visita será una experiencia gratificante.
                    Nuestra Ubicacion</h4>
            </div>

        </div>

    </section>

    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
    </div>

    <!-- Ubicación -->
    <section class="container my-5" id="ubicacion">

        <div class="container text-center titulo">
            <div class="row align-items-center">
                <div class="col">

                </div>
                <div class="col">
                    <h1>Nuestra Ubicación</h1>
                </div>
                <div class="col">

                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8 texto">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15176.976304191276!2d-92.92710644439134!3d18.013872924800804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd8129f3a7393%3A0x5cbca6fd413b9de6!2sPlaza%20Las%20Am%C3%A9ricas!5e0!3m2!1ses-419!2smx!4v1761758086074!5m2!1ses-419!2smx" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-sm-6 col-md-4 texto">
                <img src="../assets/images/maps.png" class="mapa">
                <h1>Villahermosa <br> Tabasco</h1>
                <h5>Av Prof. Ramón Mendoza Herrera 102,<br> El Recreo, 86029<br> Villahermosa, Tab.</h5>
            </div>
        </div>
    </section>

    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
    </div>

    <!-- Datos de Contacto -->
    <section class="container my-5" id="contactanos">

        <div class="container text-center titulo">
            <div class="row align-items-center">
                <div class="col">

                </div>
                <div class="col">
                    <h1>Contactanos</h1>
                </div>
                <div class="col">

                </div>
            </div>
        </div>

        <div class="container text-center titulo">
            <div class="row align-items-center">

                <div class="col">
                    <h4>Nuestro equipo agradece su visita. Para mas informacion, pueden contactarnos mediante nuestros siguientes medios.</h4>
                </div>

            </div>
        </div>

        <div class="container text-center">
            <div class="row justify-content-end texto">
                <div class="col-4">
                    <img src="../assets/images/horario.png" class="contacto titulo">
                    <h4 class="texto-contacto">Horario de servicio:<br> Lunes a Viernes de 13:00 - 1:00 <br> Sabados a Domingos de 13:00 - 3:00</h4>
                </div>
                <div class="col-4">

                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-4">

                </div>

            </div>

            <div class="row justify-content-between texto">
                <div class="col-4">
                    <img src="../assets/images/correo.png" class="contacto titulo">
                    <h4 class="texto-contacto">Correo Electronico:<br> info@restaurante.com</h4>
                </div>
                <div class="col-4">
                    <img src="../assets/images/telefono.png" class="contacto titulo">
                    <h4 class="texto-contacto">Número Teléfonico:<br> +123456789</h4>
                </div>
            </div>

        </div>

    </section>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($_GET['logout']) && $_GET['logout'] == 1): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="../assets/js/script.js"></script>

    <?php endif; ?>
</body>

</html>
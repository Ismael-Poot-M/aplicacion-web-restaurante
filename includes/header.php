<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Restaurante'; ?></title> <!-- Variable $page_title para títulos dinámicos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Estilos personalizados -->
    <link rel="shortcut icon" href="../assets/images/Letra.png" type="image/x-icon">

</head>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark header">
        <div class="container-fluid header">
            <a class="navbar-brand" href="../pages/index.php">
                <img src="../assets/images/logo-nombre-horizontal-blanco.png" alt="Restaurante" height="70" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#conocenos">Conocenos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ubicacion">¿Donde nos ubicamos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactanos">Contactanos</a>
                    </li>
                    <?php if (isLoggedIn() && isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/admin_panel.php">Panel Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/loyalty.php">Tarjetas de Lealtad</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <span class="navbar-text">Hola, <?php echo $_SESSION['username'] ?? 'Usuario'; ?>!</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar Sesión</a> <!-- Crea un archivo logout.php para destruir sesión -->
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
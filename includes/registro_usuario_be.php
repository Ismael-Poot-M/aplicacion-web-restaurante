<?php
include 'config.php';
require '../phpqrcode/qrlib.php'; // Asegúrate de tener esta librería (https://sourceforge.net/projects/phpqrcode/)

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$role = 'cliente'; // Asignar rol de cliente por defecto

// --- Validar duplicados ---
$verificar_correo = mysqli_query($conn, "SELECT * FROM users WHERE email='$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '<script>alert("Este correo ya está registrado, intenta con uno diferente"); window.location="../pages/login.php";</script>';
    exit();
}

$verificar_usuario = mysqli_query($conn, "SELECT * FROM users WHERE username='$usuario'");
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '<script>alert("Este usuario ya está registrado, intenta con uno diferente"); window.location="../pages/login.php";</script>';
    exit();
}

// --- Insertar usuario ---

$query = "INSERT INTO users (nombre, email, username, passwords, role) 
          VALUES ('$nombre', '$correo', '$usuario', '$contrasena', '$role')";

if (mysqli_query($conn, $query)) {
    // Obtener el ID del nuevo usuario
    $user_id = mysqli_insert_id($conn);

    // --- Crear tarjeta de lealtad ---
    $card_number = 'LC-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
    $qrDir = "../qrcodes/";
    if (!file_exists($qrDir)) mkdir($qrDir, 0777, true);

    // Contenido del QR (puede ser cualquier enlace o identificador único)
    $qrContent = "https://tusitio.com/lealtad.php?card=" . urlencode($card_number);
    $qrFile = $qrDir . "qr_" . $user_id . ".png";

    // Generar QR
    QRcode::png($qrContent, $qrFile, QR_ECLEVEL_L, 6);

    // Insertar tarjeta en la base de datos
    $sqlCard = "INSERT INTO loyalty_cards (user_id, card_number, qr_code, stamps)
                VALUES ('$user_id', '$card_number', '$qrFile', 0)";
    mysqli_query($conn, $sqlCard);

    echo '<script>alert("✅ Usuario registrado exitosamente. Se creó tu tarjeta de lealtad."); window.location="../pages/login.php";</script>';
} else {
    die("❌ Error al registrar usuario: " . mysqli_error($conn));
}

mysqli_close($conn);

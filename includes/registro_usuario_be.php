<?php
require_once '../includes/init.php';
require '../phpqrcode/qrlib.php'; // Asegúrate de tener esta librería (https://sourceforge.net/projects/phpqrcode/)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    $role = 'cliente'; // Asignar rol de cliente por defecto

    // Validación básica
    if (empty($nombre) || empty($correo) || empty($usuario) || empty($contrasena)) {
        die("Completa todos los campos");
    }

    // Verificar duplicados
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? OR username=?");
    $stmt->bind_param("ss", $correo, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<script>alert("Correo o usuario ya existe"); window.location="../pages/login.php";</script>';
        exit();
    }

    // Imagen
    $rutaBD = "..\assets\images\usuarios\default.png";

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {

        $nombreArchivo = time() . "_" . basename($_FILES["photo"]["name"]);
        $tmp = $_FILES["photo"]["tmp_name"];

        $rutaServidor = "..\assets\images\usuarios\\" . $nombreArchivo;

        $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png'];

        if (in_array($ext, $permitidos)) {

            if ($_FILES["photo"]["size"] <= 2 * 1024 * 1024) {

                if (move_uploaded_file($tmp, $rutaServidor)) {
                    $rutaBD = "..\assets\images\usuarios\\" . $nombreArchivo;
                }
            }
        }
    }

    // Insertar usuario
    $stmt = $conn->prepare("INSERT INTO users (nombre, email, username, passwords, role, phone, photo)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssss", $nombre, $correo, $usuario, $contrasena, $role, $telefono, $rutaBD);

    if ($stmt->execute()) {

        $user_id = $stmt->insert_id;

        // Crear tarjeta
        $card_number = 'LC-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));

        $qrDir = "../qrcodes/";
        if (!file_exists($qrDir)) mkdir($qrDir, 0777, true);

        $qrContent = "https://tusitio.com/lealtad.php?card=" . urlencode($card_number);
        $qrFile = $qrDir . "qr_" . $user_id . ".png";

        QRcode::png($qrContent, $qrFile, QR_ECLEVEL_L, 6);

        $stmtCard = $conn->prepare("INSERT INTO loyalty_cards (user_id, card_number, qr_code, stamps)
                                   VALUES (?, ?, ?, 0)");
        $stmtCard->bind_param("iss", $user_id, $card_number, $qrFile);
        $stmtCard->execute();

        echo '<script>
            alert("Usuario registrado correctamente");
            window.location="../pages/login.php";
        </script>';
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}

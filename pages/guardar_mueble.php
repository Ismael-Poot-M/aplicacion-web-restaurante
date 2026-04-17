<?php
require_once '../includes/init.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];

    // Validar imagen
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) {

        $imagenNombre = time() . "_" . $_FILES["imagen"]["name"];
        $tmp = $_FILES["imagen"]["tmp_name"];

        $rutaDestino = "../assets/images/mapeo_restaurante/" . $imagenNombre;

        // mover archivo
        move_uploaded_file($tmp, $rutaDestino);

        // posición inicial por defecto
        $pos_x = 50;
        $pos_y = 50;
        $width = 80;
        $height = 80;

        // insertar en BD
        $stmt = $conn->prepare("INSERT INTO furniture (nombre, imagen, pos_x, pos_y, width, height) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiii", $nombre, $rutaDestino, $pos_x, $pos_y, $width, $height);
        $stmt->execute();

        // recargar para ver cambios
        header("Location: reservations.php");
        exit;
    }
}
?>
<?php
require_once '../includes/init.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtener datos
    $mesa = (int) ($_POST["nmesa"] ?? 0);
    $capacidad = (int) ($_POST["capacidad"] ?? 0);
    $nombre = $_POST["nombre"] ?? null;
    $hora = $_POST["hora"] ?? null;
    $fecha = $_POST["fecha_reserva"] ?? null;
    $telefono = $_POST["telefono"] ?? null;
    $correo = $_POST["correo"] ?? null;
    $ocasion = $_POST["ocasion_especial"] ?? null;
    $solicitud = $_POST["solicitud_especial"] ?? null;

    // Validación
    if (!$mesa || !$capacidad || !$nombre || !$hora || !$fecha) {
        die("Faltan datos obligatorios");
    }

    $fecha_creacion = date("Y-m-d H:i:s");

    // INICIAR TRANSACCIÓN
    $conn->begin_transaction();

    try {

        // INSERTAR RESERVACIÓN
        $stmt = $conn->prepare("
            INSERT INTO reservations 
            (table_number, num_people, reservation_date, reservation_time, client_name, phone, email, occasion, special_request, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            throw new Exception("Error prepare: " . $conn->error);
        }

        $stmt->bind_param(
            "iissssssss",
            $mesa,
            $capacidad,
            $fecha,
            $hora,
            $nombre,
            $telefono,
            $correo,
            $ocasion,
            $solicitud,
            $fecha_creacion
        );

        if (!$stmt->execute()) {
            throw new Exception("Error insert: " . $stmt->error);
        }

        $stmt->close();

        // ACTUALIZAR STATUS DE LA MESA
        $update = $conn->prepare("
            UPDATE tables 
            SET status = 'reservada' 
            WHERE table_number = ?
        ");

        if (!$update) {
            throw new Exception("Error prepare update: " . $conn->error);
        }

        $update->bind_param("i", $mesa);

        if (!$update->execute()) {
            throw new Exception("Error update: " . $update->error);
        }

        $update->close();

        // CONFIRMAR TODO
        $conn->commit();

        header("Location: ../pages/cliente_panel.php?success=1");
        exit;
    } catch (Exception $e) {

        // SI ALGO FALLA → ROLLBACK
        $conn->rollback();

        echo "Error: " . $e->getMessage();
    }
}

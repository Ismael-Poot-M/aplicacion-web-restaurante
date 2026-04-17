<?php
// conexión a la BD
$conn = new mysqli("localhost", "root", "", "restaurante_db");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = "INSERT INTO events (title, description, date)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $date);

    if ($stmt->execute()) {
        echo "Evento registrado correctamente";
        header("Location: ../pages/events.php"); // opcional
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

<?php
require_once '../includes/init.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "No se recibieron datos"
    ]);
    exit;
}

foreach ($data as $obj) {
    $id = intval($obj['id']);
    $x = intval($obj['x']);
    $y = intval($obj['y']);
    $width = intval($obj['width']);
    $height = intval($obj['height']);

    if ($obj['type'] === 'mesa') {
        $conn->query("UPDATE tables SET pos_x=$x, pos_y=$y WHERE id=$id");
    } else if ($obj['type'] === 'mueble') {
        $conn->query("UPDATE furniture SET pos_x=$x, pos_y=$y, width=$width, height=$height WHERE id=$id");
    }
}

echo json_encode([
    "status" => "success",
    "message" => "Cambios guardados correctamente"
]);
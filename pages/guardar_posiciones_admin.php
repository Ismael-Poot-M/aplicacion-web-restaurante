<?php
include '../includes/config.php';
$data = json_decode(file_get_contents("php://input"), true);

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
echo "Posiciones y tamaños guardados correctamente.";

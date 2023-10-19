<?php
include_once __DIR__.'/database.php';

// Verifica si se recibió un JSON válido
$data = json_decode(file_get_contents("php://input"));
if ($data === null) {
    echo json_encode(array('message' => 'Error en los datos recibidos'), JSON_PRETTY_PRINT);
    exit;
}

// Validación de datos faltantes
if (empty($data->nombre) || empty($data->descripcion)) {
    echo json_encode(array('message' => 'Nombre y descripción son campos obligatorios'), JSON_PRETTY_PRINT);
    exit;
}

// Validación de existencia del producto
$nombre = mysqli_real_escape_string($conexion, $data->nombre);
$query = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    echo json_encode(array('message' => 'Ya existe un producto con este nombre'), JSON_PRETTY_PRINT);
} else {
    // Inserción del nuevo producto
    $descripcion = mysqli_real_escape_string($conexion, $data->descripcion);
    $query = "INSERT INTO productos (nombre, descripcion, eliminado) VALUES ('$nombre', '$descripcion', 0)";

    if ($conexion->query($query)) {
        echo json_encode(array('message' => 'Producto insertado con éxito'), JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array('message' => 'Error al insertar el producto'), JSON_PRETTY_PRINT);
    }
}

$conexion->close();
?>

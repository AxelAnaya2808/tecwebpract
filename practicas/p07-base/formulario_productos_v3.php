<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar datos de actualización aquí
    if (isset($_POST['id_producto']) && is_numeric($_POST['id_producto'])) {
        // Conecta a la base de datos
        $link = @new mysqli('localhost', 'root', '2808', 'marketzone');

        // Verifica la conexión
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error);
        }

        // Escapa los datos para evitar inyección de SQL
        $id_producto = $link->real_escape_string($_POST['id_producto']);
        $nombre_producto = $link->real_escape_string($_POST['nombre_producto']);
        $marca_producto = $link->real_escape_string($_POST['marca_producto']);
        $modelo_producto = $link->real_escape_string($_POST['modelo_producto']);
        $precio_producto = floatval($_POST['precio_producto']);
        $detalles_producto = $link->real_escape_string($_POST['detalles_producto']);
        $unidades_producto = intval($_POST['unidades_producto']);

        // Actualiza el registro en la base de datos
        $sql = "UPDATE productos SET 
                nombre = '$nombre_producto',
                marca = '$marca_producto',
                modelo = '$modelo_producto',
                precio = $precio_producto,
                detalles = '$detalles_producto',
                unidades = $unidades_producto
                WHERE id = $id_producto";

        if ($link->query($sql)) {
            // Obtener los datos actualizados
            $sql_select = "SELECT * FROM productos WHERE id = $id_producto";
            $result = $link->query($sql_select);
            $row = $result->fetch_assoc();

            // Mostrar la alerta con los datos actualizados
            echo '<script>alert("Producto Actualizado Exitosamente!\n\nID: ' . $row['id'] . '\nNombre: ' . $row['nombre'] . '\nMarca: ' . $row['marca'] . '\nModelo: ' . $row['modelo'] . '\nPrecio: $' . number_format($row['precio'], 2) . '\nDetalles: ' . $row['detalles'] . '\nUnidades: ' . $row['unidades'] . '");</script>';
            // Redirige al usuario a la lista de productos vigentes
            echo '<script>window.location.href = "get_productos_vigentes_v2.php";</script>';
            exit; // Termina el script para evitar que se procese más HTML
        } else {
            echo "Error al actualizar el producto: " . $link->error;
        }

        // Cierra la conexión
        $link->close();
    } else {
        echo "ID de producto no válido.";
    }
}
?>

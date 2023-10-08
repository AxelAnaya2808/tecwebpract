<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Actualización de Productos</title>
</head>
<body>
    <h1>Formulario de Actualización de Productos</h1>

    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_producto = $_GET['id'];
        // Conecta a la base de datos y obtiene los detalles del producto
        $link = mysqli_connect("localhost", "root", "2808", "marketzone");
        if ($link === false) {
            die("ERROR: No se pudo conectar con la DB. " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM productos WHERE id = $id_producto";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                // Rellena el formulario con los detalles del producto
                $nombre = $row['nombre'];
                $marca = $row['marca'];
                $modelo = $row['modelo'];
                $precio = $row['precio'];
                $detalles = $row['detalles'];
                $unidades = $row['unidades'];
                $imagen = $row['imagen'];
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "ERROR: No se pudo ejecutar la consulta SQL. " . mysqli_error($link);
        }
        mysqli_close($link);
    } else {
        echo "ID de producto no válido.";
    }
    ?>
    <form action="formulario_productos_v3.php" method="POST">
        <!-- Campo oculto para almacenar el ID del producto -->
        <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">

        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" name="nombre_producto" value="<?php echo $nombre; ?>" required><br>

        <label for="marca_producto">Marca:</label>
        <input type="text" name="marca_producto" value="<?php echo $marca; ?>" required><br>

        <label for="modelo_producto">Modelo:</label>
        <input type="text" name="modelo_producto" value="<?php echo $modelo; ?>" required><br>

        <label for="precio_producto">Precio:</label>
        <input type="text" name="precio_producto" value="<?php echo $precio; ?>" required pattern="\d+(\.\d{2})?" title="Formato válido: 99.99"><br>

        <label for="detalles_producto">Detalles:</label>
        <textarea name="detalles_producto" rows="4" required><?php echo $detalles; ?></textarea><br>

        <label for="unidades_producto">Unidades:</label>
        <input type="number" name="unidades_producto" value="<?php echo $unidades; ?>" required><br>

        <!-- Nuevo campo para la ruta de la imagen -->
        <label for="imagen_producto">Nueva Ruta de la Imagen:</label>
        <input type="text" name="imagen_producto" value="<?php echo $imagen; ?>"><br>

        <!-- Otros campos que necesites agregar -->

        <input type="submit" value="Actualizar Producto">
    </form>
</body>
</html>

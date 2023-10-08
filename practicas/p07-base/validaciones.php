<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Producto</title>
</head>
<body>
    <h1>STARKSHOES (tienda de calzado)</h1>
    <form method="post" action="formulario_productos_v2.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required maxlength="100"><br><br>

        <label for="marca">Marca:</label>
        <select id="marca" name="marca" required>
            <option value="">Selecciona la marca de tenis</option>
            <option value="Marca1">Adidas</option>
            <option value="Marca2">Nike</option>
            <option value="Marca3">Vans</option>
            <option value="Marca4">Pirma</option>
            <option value="Marca5">Charlie</option>
            <option value="Marca6">Lacoste</option>
        </select><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required pattern="^[a-zA-Z0-9\s]*$" maxlength="25"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required min="99.99"><br><br>

        <label for="detalles">Detalles:</label>
        <textarea id="detalles" name="detalles" maxlength="250"></textarea><br><br>

        <label for="unidades">Unidades:</label>
        <input type="number" id="unidades" name="unidades" required min="0"><br><br>

        <label for="imagen">Ruta de la imagen (opcional):</label>
        <input type="text" id="imagen" name="imagen"><br><br>

        <button type="submit" name="submit">Registrar Producto</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nombre = $_POST["nombre"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $precio = $_POST["precio"];
        $detalles = $_POST["detalles"];
        $unidades = $_POST["unidades"];
        $imagen = $_POST["imagen"];

        // Realizar las validaciones aquí
        $errors = [];

        if (empty($nombre) || strlen($nombre) > 100) {
            $errors[] = "El nombre es requerido y debe tener 100 caracteres o menos.";
        }

        if (empty($marca)) {
            $errors[] = "Debes seleccionar una marca.";
        }

        if (empty($modelo) || strlen($modelo) > 25 || !preg_match("/^[a-zA-Z0-9\s]*$/", $modelo)) {
            $errors[] = "El modelo es requerido, debe tener 25 caracteres o menos y contener solo caracteres alfanuméricos.";
        }

        if (!is_numeric($precio) || $precio <= 99.99) {
            $errors[] = "El precio es requerido y debe ser mayor a 99.99.";
        }

        if (strlen($detalles) > 250) {
            $errors[] = "Los detalles deben tener 250 caracteres o menos.";
        }

        if (!is_numeric($unidades) || $unidades < 0) {
            $errors[] = "Las unidades son requeridas y deben ser un número mayor o igual a 0.";
        }

        if (empty($imagen)) {
            $imagen = "ruta_por_defecto.jpg"; // Ruta de imagen por defecto
        }

        if (empty($errors)) {
            /* MySQL Conexion */
            $link = mysqli_connect("localhost", "root", "2808", "marketzone");
            // Chequea conección
            if ($link === false) {
                die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
            }
            // Escapar las variables para evitar SQL Injection
            $nombre = mysqli_real_escape_string($link, $nombre);
            $marca = mysqli_real_escape_string($link, $marca);
            $modelo = mysqli_real_escape_string($link, $modelo);
            $precio = floatval($precio);
            $detalles = mysqli_real_escape_string($link, $detalles);
            $unidades = intval($unidades);
            $imagen = mysqli_real_escape_string($link, $imagen);

            // Insertar nuevo producto en la base de datos
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                    VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen')";

            if (mysqli_query($link, $sql)) {
                echo "Producto registrado exitosamente!<br>";
                echo "Nombre: $nombre<br>";
                echo "Marca: $marca<br>";
                echo "Modelo: $modelo<br>";
                echo "Precio: $precio<br>";
                echo "Detalles: $detalles<br>";
                echo "Unidades: $unidades<br>";
                echo "Imagen: $imagen<br>";

                // Redireccionar a la página de productos vigentes
                header("Location: get_productos_vigentes_v2.php");
                exit();
            } else {
                echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
            }
            // Cierra la conexión
            mysqli_close($link);
        } else {
            // Mostrar errores de validación
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
    ?>
</body>
</html>

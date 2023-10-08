<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script>
        function editProduct(id) {
            window.location.href = 'formulario_productos_v2.php?id=' + id;
        }
    </script>
</head>
<body>
    <h3>PRODUCTOS</h3>
    <br/>

    <!-- Formulario para ingresar el valor de "tope" -->
    <form method="GET">
        <label for="tope">Mostrar productos con unidades menores o iguales a:</label>
        <input type="number" id="tope" name="tope" value="<?php echo isset($_GET['tope']) ? $_GET['tope'] : ''; ?>" />
        <input type="submit" value="Mostrar">
    </form>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio</th>
                <th scope="col">Unidades</th>
                <th scope="col">Detalles</th>
                <th scope="col">Imagen</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $mysqli = new mysqli('localhost', 'root', '2808', 'marketzone');
            if ($mysqli->connect_errno) {
                die('Falló la conexión: ' . $mysqli->connect_error . '<br/>');
            }

            // Obtener el valor de "tope" de la URL o establecer un valor predeterminado
            $tope = isset($_GET['tope']) ? intval($_GET['tope']) : 0;

            // Consulta SQL para obtener los productos según el "tope" sin la condición de eliminados
            $sql = "SELECT * FROM productos WHERE unidades <= $tope OR $tope = 0";
            $result = $mysqli->query($sql);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row['id'] . '</th>';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['marca'] . '</td>';
                    echo '<td>' . $row['modelo'] . '</td>';
                    echo '<td>' . $row['precio'] . '</td>';
                    echo '<td>' . $row['unidades'] . '</td>';
                    echo '<td>' . utf8_encode($row['detalles']) . '</td>';
                    echo '<td><img src="' . $row['imagen'] . '" /></td>';
                    echo '<td><input type="button" value="Editar" onclick="editProduct(' . $row['id'] . ')" /></td>';
                    echo '</tr>';
                }

                $result->free();
            } else {
                echo "Error en la consulta SQL: " . $mysqli->error;
            }

            $mysqli->close();
            ?>
        </tbody>
    </table>
</body>
</html>

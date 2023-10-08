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

    <table class="table">
        <tbody>
        <table class="table">;
        <thead class="thead-dark">;
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

            <?php
            // Conexión a la base de datos
            $mysqli = new mysqli('localhost', 'root', '2808', 'marketzone');
            if ($mysqli->connect_errno) {
                die('Falló la conexión: ' . $mysqli->connect_error . '<br/>');
            }
            echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
            echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">';
            echo '<head>';
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo '<title>Productos Vigentes</title>';
            echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
            echo '</head>';
            echo '<body>';
            echo '<h3>PRODUCTOS VIGENTES</h3>';
            echo '<br/>';

            
            // Consulta SQL para obtener los productos
            $sql = "SELECT * FROM productos WHERE eliminado = 0";
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
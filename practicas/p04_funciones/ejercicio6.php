<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 6 Parque Vehicular</title>
</head>
<body>
    <h1>Parque Vehicular</h1>
    <?php
    $parqueVehicular = array(
        "UBN6338" => array(
            "Auto" => array(
                "marca" => "HONDA",
                "modelo" => 2020,
                "tipo" => "BR-V"
            ),
            "Propietario" => array(
                "nombre" => "Alfonzo Esparza",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "C.U., Jardines de San Manuel"
            )
        ),
        "UBN6339" => array(
            "Auto" => array(
                "marca" => "MAZDA",
                "modelo" => 2019,
                "tipo" => "SEDAN"
            ),
            "Propietario" => array(
                "nombre" => "Ma. del Consuelo Molina",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "97 oriente"
            )
        ),
        // Agrega aquí los registros para los otros autos.
        "UBN6340" => array(
            "Auto" => array(
                "marca" => "VW",
                "modelo" => 2011,
                "tipo" => "JETTA"
            ),
            "Propietario" => array(
                "nombre" => "Axel Anaya Contreras",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Privada Alamos"
            )
        ),
        "UBN6341" => array(
            "Auto" => array(
                "marca" => "CHEVROLET",
                "modelo" => 2019,
                "tipo" => "AVEO"
            ),
            "Propietario" => array(
                "nombre" => "Juan Carlos Conde Ramirez",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "blvd nte #85200"
            )
        ),
    );

    // Mostrar la estructura general del arreglo con print_r
    echo "<h2>Información de vehículos registrados:</h2>";
    echo "<pre>";
    print_r($parqueVehicular);
    echo "</pre>";

    // Formulario para consultar información por matrícula
    ?>
    <h2>Consultar información por matrícula de auto</h2>
    <form method="GET" action="">
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula" required>
        <input type="submit" value="Consultar">
    </form>

    <?php
    // Procesar la consulta por matrícula
    if (isset($_GET["matricula"])) {
        $matriculaConsultada = $_GET["matricula"];
        if (array_key_exists($matriculaConsultada, $parqueVehicular)) {
            $infoAuto = $parqueVehicular[$matriculaConsultada]["Auto"];
            $infoPropietario = $parqueVehicular[$matriculaConsultada]["Propietario"];
            echo "<h3>Información del auto con matrícula $matriculaConsultada</h3>";
            echo "<p>Marca: " . $infoAuto["marca"] . "</p>";
            echo "<p>Modelo: " . $infoAuto["modelo"] . "</p>";
            echo "<p>Tipo: " . $infoAuto["tipo"] . "</p>";
            echo "<h3>Información del propietario</h3>";
            echo "<p>Nombre: " . $infoPropietario["nombre"] . "</p>";
            echo "<p>Ciudad: " . $infoPropietario["ciudad"] . "</p>";
            echo "<p>Dirección: " . $infoPropietario["direccion"] . "</p>";
        } else {
            echo "<p>No se encontró información para la matrícula $matriculaConsultada.</p>";
        }
    }

    // Formulario para mostrar información de todos los autos registrados
    ?>
    <h2>Mostrar información de todos los autos registrados</h2>
    <form method="GET" action="">
        <input type="hidden" name="mostrar_todos" value="1">
        <input type="submit" value="Mostrar Todos">
    </form>

    <?php
    // Mostrar información de todos los autos registrados
    if (isset($_GET["mostrar_todos"])) {
        echo "<h3>Información de todos los autos registrados:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th>Tipo</th><th>Propietario</th></tr>";
        foreach ($parqueVehicular as $matricula => $info) {
            $infoAuto = $info["Auto"];
            $infoPropietario = $info["Propietario"];
            echo "<tr>";
            echo "<td>$matricula</td>";
            echo "<td>" . $infoAuto["marca"] . "</td>";
            echo "<td>" . $infoAuto["modelo"] . "</td>";
            echo "<td>" . $infoAuto["tipo"] . "</td>";
            echo "<td>" . $infoPropietario["nombre"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>

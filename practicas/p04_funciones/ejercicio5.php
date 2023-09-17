<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 5</title>
</head>
<body>
    <h1>Ejercicio 5: Identificar una persona por edad y sexo</h1>
    <form method="POST" action="">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required>
        <br>
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
        </select>
        <br>
        <input type="submit" value="Verificar">
    </form>
    <?php
    if (isset($_POST["edad"]) && isset($_POST["sexo"])) {
        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];
        if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
            echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
        } else {
            echo "<p>Lo sentimos, no cumple con los requisitos.</p>";
        }
    }
    ?>
</body>
</html>

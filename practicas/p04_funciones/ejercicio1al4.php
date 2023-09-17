<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Ejercicios 1 al 4</title>
</head>
<body>
    <h1>Prueba de Ejercicios 1 al 4</h1>

    <!-- Ejercicio 1: Comprobar si un número es múltiplo de 5 y 7 -->
    <h2>Ejercicio 1: Comprobar si un número es múltiplo de 5 y 7</h2>
    <form method="GET" action="">
        <label for="numero">Ingrese un número:</label>
        <input type="number" name="numero" id="numero" required>
        <input type="submit" value="Comprobar">
    </form>
    <?php
    if (isset($_GET["numero"])) {
        $numero = $_GET["numero"];
        if ($numero % 5 == 0 && $numero % 7 == 0) {
            echo "<p>$numero es múltiplo de 5 y 7.</p>";
        } else {
            echo "<p>$numero no es múltiplo de 5 y 7.</p>";
        }
    }
    ?>

    <!-- Ejercicio 2: Generar una secuencia de 3 números aleatorios -->
    <h2>Ejercicio 2: Generar una secuencia de 3 números aleatorios (impar, par, impar)</h2>
    <?php
    function generarSecuenciaAleatoria() {
        $secuencia = array();
        $iteraciones = 0;
        
        do {
            $numero1 = rand(1, 999);
            $numero2 = rand(1, 999);
            $numero3 = rand(1, 999);
            $secuencia = array($numero1, $numero2, $numero3);
            $iteraciones++;
        } while (!esSecuenciaImparParImpar($secuencia));
        
        return array('secuencia' => $secuencia, 'iteraciones' => $iteraciones);
    }

    function esSecuenciaImparParImpar($secuencia) {
        return ($secuencia[0] % 2 != 0 && $secuencia[1] % 2 == 0 && $secuencia[2] % 2 != 0);
    }

    if (isset($_GET["generar_secuencia"])) {
        $resultado = generarSecuenciaAleatoria();
        $secuenciaGenerada = $resultado['secuencia'];
        $iteraciones = $resultado['iteraciones'];

        echo "<p>Secuencia generada: " . implode(", ", $secuenciaGenerada) . "</p>";
        echo "<p>$iteraciones iteraciones para obtener la secuencia.</p>";
    }
    ?>

    <form method="GET" action="">
        <input type="hidden" name="generar_secuencia" value="1">
        <input type="submit" value="Generar Secuencia">
    </form>

    <!-- Ejercicio 3: Encontrar el primer número entero múltiplo de un número dado -->
    <h2>Ejercicio 3: Encontrar el primer número entero múltiplo de un número dado</h2>
    <form method="GET" action="">
        <label for="multiplo">Ingrese un número para encontrar su múltiplo:</label>
        <input type="number" name="multiplo" id="multiplo" required>
        <input type="submit" value="Encontrar Múltiplo">
    </form>
    <?php
    if (isset($_GET["multiplo"])) {
        $multiploDado = $_GET["multiplo"];
        $numeroAleatorio = rand(1, 999);
        while ($numeroAleatorio % $multiploDado != 0) {
            $numeroAleatorio = rand(1, 999);
        }
        echo "<p>El primer número entero aleatorio múltiplo de $multiploDado es: $numeroAleatorio</p>";
    }
    ?>

    <!-- Ejercicio 4: Mostrar el arreglo de letras -->
    <h2>Ejercicio 4: Arreglo de Letras</h2>
    <table>
        <tr>
            <th>Índice</th>
            <th>Letra</th>
        </tr>
        <?php
        $arregloLetras = array();
        for ($i = 97; $i <= 122; $i++) {
            $letra = chr($i);
            $arregloLetras[$i] = $letra;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$letra</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

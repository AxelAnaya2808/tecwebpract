<h2>Ejercicio 2</h2>
<p>Proporcionar los valores de $a, $b, $c como sigue:</p>
<p>$a = “ManejadorSQL”;
$b = 'MySQL’;
$c = &$a;</p>

<?php

$a = "ManejadorSQL";
$b = 'MySQL';
$c = &$a;

// a. Muestra el contenido de cada variable
echo "Contenido de \$a: $a<br>";
echo "Contenido de \$b: $b<br>";
echo "Contenido de \$c: $c<br>";

$a = "PHP server";
$b = &$a;

// b. Muestra el contenido de cada uno después de las nuevas asignaciones
echo "Contenido de \$a después de la segunda asignación: $a<br>";
echo "Contenido de \$b después de la segunda asignación: $b<br>";

// c. Describe lo que ocurrió en el segundo bloque de asignaciones
// En el segundo bloque de asignaciones, $a se actualiza a "PHP server" y $b se actualiza para hacer referencia a $a.
// Como resultado, tanto $a como $b ahora contienen "PHP server", ya que $b es una referencia a $a.
?>

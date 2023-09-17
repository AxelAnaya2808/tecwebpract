<h2>Ejercicio 3</h2>
<p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
verificar la evolución del tipo de estas variables (imprime todos los componentes de los
arreglo): <br>
$a = “PHP5”;<br>
$z[] = &$a;<br>
$b = “5a version de PHP”;<br>
$c = $b*10;<br>
$a .= $b;<br>
$b *= $c;<br>
$z[0] = “MySQL”; <br> </p>

<?php
$a = "PHP5";
$z[] = &$a;
$b = "5a version de PHP";
@$c = $b*10;
$a .= $b;
$b *= $c;
$z[0] = "MySQL";

// Muestra el contenido de cada variable inmediatamente después de cada asignación
echo "Contenido de \$a después de la primera asignación: $a<br>";
echo "Contenido de \$b después de la segunda asignación: $b<br>";
echo "Contenido de \$c después de la tercera asignación: $c<br>";
echo "Contenido de \$z[0] después de la cuarta asignación: {$z[0]}<br>";
?>
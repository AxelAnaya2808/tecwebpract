<h2>Ejercicio 5</h2>
<p> Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
usando la función var_dump(<datos>).<br>
Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
en uno que se pueda mostrar con un echo: <br>
<?php

$a = "0";
$b = "TRUE";
$c = FALSE;
$d = ($a OR $b);
$e = ($a AND $c);
$f = ($a XOR $b);

// Valores booleanos de las variables
var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);
var_dump($e);
var_dump($f);

// Transformar $c y $e en un valor que se pueda mostrar con un echo
$c = (bool)$c;
$e = (bool)$e;
echo "Valor booleano de \$c después de la conversión: " . ($c ? 'TRUE' : 'FALSE') . "<br>";
echo "Valor booleano de \$e después de la conversión: " . ($e ? 'TRUE' : 'FALSE') . "<br>";
?>

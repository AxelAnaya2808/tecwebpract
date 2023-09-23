<h2>Ejercicio 7</h2>
<p> Usando la variable predefinida $_SERVER, determina lo siguiente: 
a. La versión de Apache y PHP <br>
b. El nombre del sistema operativo (servidor) <br>
c. El idioma del navegador (cliente). <br>
<?php

// Usando $_SERVER para obtener información
echo "Versión de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Versión de PHP: " . phpversion() . "<br>";
echo "Nombre del sistema operativo del servidor: " . php_uname('s') . "<br>";
echo "Idioma del navegador del cliente: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
?>

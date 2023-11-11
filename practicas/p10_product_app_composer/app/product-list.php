<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Read\Read;
    require_once __DIR__ .'/start.php';
    //Se crea un objeto de la clase
    $lista_productos = new Read();
    $lista_productos->list();
    echo $lista_productos->getResponse();
    
?>
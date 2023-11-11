<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Create\Create;
    require_once __DIR__ .'/start.php';

    $productos = new Create();
    $productos->add( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
    
?>

    
    

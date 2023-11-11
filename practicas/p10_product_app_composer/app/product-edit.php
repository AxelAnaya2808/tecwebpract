<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Update\Update;
    require_once __DIR__ .'/start.php';

    $productos = new Update();
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();

    
?>
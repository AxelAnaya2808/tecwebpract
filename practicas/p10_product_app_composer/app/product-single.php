<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Read\Read;
    require_once __DIR__ .'/start.php';

    $productos = new Read();
    $productos->single( $_POST['id'] );
    echo $productos->getResponse();
?>
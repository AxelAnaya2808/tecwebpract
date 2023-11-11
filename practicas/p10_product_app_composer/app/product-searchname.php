<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Read\Read;
    require_once __DIR__ .'/start.php';
    

    $busca_nombre = new Read();
    if( isset($_GET['search']) ) {
        $search = $_GET['search'];
        $busca_nombre->singleByName($search);
    } 
    
    echo $busca_nombre->getResponse();
?>
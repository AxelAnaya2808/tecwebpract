<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Read\Read;
    require_once __DIR__ .'/start.php';

    // SE CREA EL OBJETO DE LA CLASE QUE SE VA A DEVOLVER
    $busqueda = new Read();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['search']) ) {
        $search = $_GET['search'];
        //SE LLAMA A LA FUNCION SEARCH PASANDO COMO PARAMETRO EL ID
        $busqueda->search($search);
    } 
    
    //SE MANDA EL RESULTADO A LA PAGINA
    echo $busqueda->getResponse();

?>
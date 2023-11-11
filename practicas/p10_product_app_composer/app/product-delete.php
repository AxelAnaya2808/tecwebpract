<?php
    //include_once __DIR__.'/API/Productos.php';
    use API\Delete\Delete;
    require_once __DIR__ .'/start.php';
    
    $eliminar = new Delete();
    if( isset($_POST['id'])){ //checa que se reciba
        $id = $_POST['id']; // se asigna 
        $eliminar->delete($id); // el objeto creado pasa por parametro la variable a la funcion 
    }
    echo $eliminar->getResponse(); // se manda a response ya que es quien recibe todo
?>
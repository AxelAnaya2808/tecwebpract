<?php
namespace API\Delete;
use API\DataBase\DataBase;

require_once __DIR__ .'/../DataBase/DataBase.php';

class Delete extends DataBase{
    public function delete($id){
        $this->response['status'] = "error";
        $this->response['message'] = "La consulta fallo";

        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
        if($this->conexion->query($sql)){
            $this->response['status'] = "success";
            $this->response['message'] =  "Producto eliminado";
        }else{
            $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }
}
?>
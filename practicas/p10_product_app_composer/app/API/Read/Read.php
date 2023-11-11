<?php
namespace API\Read;
use API\DataBase\DataBase;
require_once __DIR__ . '/../DataBase/DataBase.php';

class Read extends DataBase{
    public function list(){
        //SE REALIZA LA QUERY DE BÚSQUEDA
        $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0", MYSQLI_USE_RESULT);
        // SOLO SI NO ESTA VACIO SE OBTIENEN LOS RESULTADOS
        if($result){ 
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function search($search){
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if($result = $this->conexion->query($sql)){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)){
                foreach($rows as $num => $row){
                    foreach($row as $key => $value){
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
        $result->free();
        }else{
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function single($id) {
        if( isset($id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();
    
                if(!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($row as $key => $value) {
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function singleByName($search){
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE (nombre = '{$search}') AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }



}
?>
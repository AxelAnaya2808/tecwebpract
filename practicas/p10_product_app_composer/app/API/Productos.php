<?php
    //require_once __DIR__ . '/DataBase.php';
    
    //la clase Productos extiendiende a DataBase
    class Productos extends DataBase{
        private $response; //atributo de la clase
        
        //constructor de la clase 
        public function __construct($database='marketzone'){ //pasa como atributo el nombre de la BD
            $this->response = array(); 
            parent::__construct($database); //uso de constructor de superclase
        }

        public function getResponse(){
            $resultado = json_encode($this->response, JSON_PRETTY_PRINT);
            return $resultado;
        }

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


        public function add($jsonOBJ) {
            // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
            $this->response = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            if(isset($jsonOBJ->nombre)) {
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                    if($this->conexion->query($sql)){
                        $this->response['status'] =  "success";
                        $this->response['message'] =  "Producto agregado";
                    } else {
                        $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                    }
                }
    
                $result->free();
                // Cierra la conexion
                $this->conexion->close();
            }
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


        public function edit($jsonOBJ) {
            $this->response = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );
            if( isset($jsonOBJ->id) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql =  "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
                $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',"; 
                $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";
                $this->conexion->set_charset("utf8");
                if ( $this->conexion->query($sql) ) {
                    $this->response['status'] =  "success";
                    $this->response['message'] =  "Producto actualizado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            }
        }


    }
?>
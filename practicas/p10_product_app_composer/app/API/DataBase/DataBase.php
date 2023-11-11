<?php
    namespace API\DataBase;

    abstract class DataBase{
        protected $conexion;
        protected $response;

        public function __construct($database='marketzone'){
            //Haciendo conexión con la base de datos
            $this->conexion = @mysqli_connect('localhost', 'root', '2808', $database);
            //Creando el arreglo de respuesta
            $this->response = array();

            if ($this->conexion->connect_errno) {
                die("Fallo al tratar de conectar con MYSQL: (".$this->conexion->connect_errno.")");
            }
        }

        public function getResponse(){
            $stringResult = json_encode($this->response, JSON_PRETTY_PRINT);
            return $stringResult;
        }
    }
?>
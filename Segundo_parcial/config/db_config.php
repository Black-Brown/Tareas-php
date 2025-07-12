<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_visitas');

class database {

    private $conn;

    public function __construct(){
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME );
        if($this->conn->connect_error){
            die("error al conectar a la base de dato" . $this->conn->connect_error);
        }
    }


    public function obtenerDB(){
        return $this->conn;
    }
}
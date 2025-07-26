<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rubia_db');

class database {

    private $conn;

    public function __construct(){
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->conn->connect_error){
            die('ERROR al conectar con la base de datos' . $this->conn->connect_error);
        }
    }

    public function getDB(){
        return $this->conn;
    }
}
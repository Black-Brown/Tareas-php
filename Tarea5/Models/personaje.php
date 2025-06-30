<?php
require_once(__DIR__ . '/../config/db_config.php');

class Personaje {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function obtenerPersonajes() {
        $sql = "SELECT * FROM personaje";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function __destruct() {
        $this->conn->close();
    }

}
<?php

require_once __DIR__ . '/../config/config_db.php';

class visitaModel {

    private $conn;

    public function __construct(){
        $db = new database();
        $this->conn = $db->obtenerDB();
    }

    public function obtenerVisitas(){
        $sql = "SELECT * FROM visitas";
        $resutado = $this->conn->query($sql);
        return $resutado;
    }

    public function crearVisitas($telefono, $nombre, $apellido, $correo){
        $sql = "INSERT INTO visitas (telefono, nombre, apellido, correo_electronico) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $telefono, $nombre, $apellido, $correo);
        return $stmt->execute();
    }

    public function __destruct(){
        $this->conn->close();
    }

    
}
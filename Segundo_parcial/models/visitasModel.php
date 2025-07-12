<?php
// se importan los modulos necesarios 
require_once __DIR__ . '/../config/db_config.php';

class visitaModel {

    // se crea la conexion a la base de datos 
    private $conn;

    public function __construct(){
        $db = new database();
        $this->conn = $db->obtenerDB();
    }

    // funcion para obtener todos los datos de la base de datos 
    public function obtenerVisitas(){
        $sql = "SELECT * FROM visitas";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }

    // funcion para insertar los datos del formulario a la base de datos
    public function crearVisitas($telefono, $nombre, $apellido, $correo){
        $sql = "INSERT INTO visitas (telefono, nombre, apellido, correo_electronico) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $telefono, $nombre, $apellido, $correo);
        return $stmt->execute();
    }


    public function __destruct(){
        $this->conn->close();
    }
}
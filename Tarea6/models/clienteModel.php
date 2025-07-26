<?php
require_once __DIR__ . "/../config/database.php";

class clienteModel {

    private $conn;

    public function __construct(){
        $db = new database();
        $this->conn = $db->getDB();
    }

    // Método para crear un nuevo cliente
    public function crearCliente($codigo, $nombre) {
        $stmt = $this->conn->prepare("INSERT INTO clientes (codigo, nombre) VALUES (?, ?)");
        $stmt->bind_param("ss", $codigo, $nombre);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Método para obtener todos los clientes
    public function obtenerClientes() {
        $stmt = $this->conn->prepare("SELECT * FROM clientes");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function __destruct(){
        $this->conn->close();
    }
}


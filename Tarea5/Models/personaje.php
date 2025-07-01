<?php
require_once(__DIR__ . '/../config/db_config.php');

class Personaje {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Error de conexion: " . $this->conn->connect_error);
        }
    }

    public function obtenerPersonajes() {
        $sql = "SELECT * FROM personajes";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function obtenerPersonajePorId($id) {
        $sql = "SELECT * FROM personajes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function crearPersonaje($nombre, $tipo, $color, $nivel, $foto) {
        $sql = "INSERT INTO personajes (nombre, tipo, color, nivel, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssis", $nombre, $tipo, $color, $nivel, $foto);
        return $stmt->execute();
    }

    public function editarPersonaje($id, $nombre, $tipo, $color, $nivel, $foto) {
        $sql = "UPDATE personajes SET nombre = ?, tipo = ?, color = ?, nivel = ?, foto = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssisi", $nombre, $tipo, $color, $nivel, $foto, $id);
        return $stmt->execute();
    }

    public function eliminarPersonaje($id) {
        $sql = "DELETE FROM personajes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }

}
<?php
require_once __DIR__ . '/../config/database.php';

class CategoriaModel {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->getDB();
    }

    // Crear categoría
    public function crearCategoria($nombre, $descripcion) {
        $stmt = $this->conn->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $descripcion);
        return $stmt->execute();
    }

    // Leer todas las categorías
    public function obtenerCategorias() {
        $result = $this->conn->query("SELECT * FROM categorias");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Leer una categoría por ID
    public function obtenerCategoriaPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Actualizar categoría
    public function actualizarCategoria($id, $nombre, $descripcion) {
        $stmt = $this->conn->prepare("UPDATE categorias SET nombre=?, descripcion=? WHERE id=?");
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        return $stmt->execute();
    }

    // Eliminar categoría
    public function eliminarCategoria($id) {
        $stmt = $this->conn->prepare("DELETE FROM categorias WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
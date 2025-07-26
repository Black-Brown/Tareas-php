<?php
require_once __DIR__ . '/../config/database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->getDB();
    }

    // Crear producto
    public function crearProducto($codigo, $nombre, $descripcion, $precio_compra, $precio_venta, $stock_actual, $stock_minimo, $categoria_id) {
        $stmt = $this->conn->prepare("INSERT INTO productos (codigo, nombre, descripcion, precio_compra, precio_venta, stock_actual, stock_minimo, categoria_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssddiii", $codigo, $nombre, $descripcion, $precio_compra, $precio_venta, $stock_actual, $stock_minimo, $categoria_id);
        return $stmt->execute();
    }

    // Leer todos los productos
    public function obtenerProductos() {
        $result = $this->conn->query("SELECT p.*, c.nombre AS categoria_nombre FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Leer un producto por ID
    public function obtenerProductoPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Actualizar producto
    public function actualizarProducto($id, $codigo, $nombre, $descripcion, $precio_compra, $precio_venta, $stock_actual, $stock_minimo, $categoria_id) {
        $stmt = $this->conn->prepare("UPDATE productos SET codigo=?, nombre=?, descripcion=?, precio_compra=?, precio_venta=?, stock_actual=?, stock_minimo=?, categoria_id=? WHERE id=?");
        $stmt->bind_param("sssddiiii", $codigo, $nombre, $descripcion, $precio_compra, $precio_venta, $stock_actual, $stock_minimo, $categoria_id, $id);
        return $stmt->execute();
    }

    // Eliminar producto
    public function eliminarProducto($id) {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Obtener todas las categorías
    public function obtenerCategorias() {
        $result = $this->conn->query("SELECT * FROM categorias");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function __destruct() {
        $this->conn->close();
    }
}

?>
<?php
require_once __DIR__ . '/../config/database.php';

class SistemaModelo {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->getDB();
    }

    // Obtener todos los productos
    public function obtenerProductos() {
        $result = $this->conn->query("SELECT id, nombre, precio_venta FROM productos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Buscar cliente por código
    public function buscarClientePorCodigo($codigo) {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Registrar cliente
    public function registrarCliente($codigo, $nombre) {
        $stmt = $this->conn->prepare("INSERT INTO clientes (codigo, nombre) VALUES (?, ?)");
        $stmt->bind_param("ss", $codigo, $nombre);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Registrar factura
    public function registrarFactura($numero_recibo, $cliente_id, $usuario_id, $subtotal, $total, $metodo_pago, $comentario) {
        $stmt = $this->conn->prepare("INSERT INTO facturas (numero_recibo, cliente_id, usuario_id, subtotal, total, metodo_pago, comentario) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siidsss", $numero_recibo, $cliente_id, $usuario_id, $subtotal, $total, $metodo_pago, $comentario);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Registrar detalle de factura
    public function registrarDetalle($factura_id, $producto_id, $cantidad, $precio_unitario, $subtotal) {
        $stmt = $this->conn->prepare("INSERT INTO factura_detalles (factura_id, producto_id, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiidd", $factura_id, $producto_id, $cantidad, $precio_unitario, $subtotal);
        $stmt->execute();
    }

    // Actualizar stock
    public function actualizarStock($producto_id, $cantidad) {
        $stmt = $this->conn->prepare("UPDATE productos SET stock_actual = stock_actual - ? WHERE id = ?");
        $stmt->bind_param("ii", $cantidad, $producto_id);
        $stmt->execute();
    }
}
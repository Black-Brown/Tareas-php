<?php
require_once __DIR__ . '/../config/database.php';

class FacturaModel {
    private $conn;

    public function __construct() {
        $this->conn = getDB(); // Asegúrate de tener esta función en config/database.php
    }

    // Obtener todas las facturas con cliente y usuario
    public function obtenerFacturas() {
        $sql = "SELECT f.*, c.nombre AS cliente_nombre, u.nombre AS usuario_nombre
                FROM facturas f
                LEFT JOIN clientes c ON f.cliente_id = c.id
                LEFT JOIN usuarios u ON f.usuario_id = u.id
                ORDER BY f.fecha_factura DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener una sola factura
    public function obtenerFacturaPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM facturas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Crear nueva factura
    public function crearFactura($datos) {
        $stmt = $this->conn->prepare("INSERT INTO facturas 
            (numero_recibo, cliente_id, usuario_id, subtotal, descuento, impuesto, total, metodo_pago, estado, comentario) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sii.ddddsss", 
            $datos['numero_recibo'], $datos['cliente_id'], $datos['usuario_id'],
            $datos['subtotal'], $datos['descuento'], $datos['impuesto'], $datos['total'],
            $datos['metodo_pago'], $datos['estado'], $datos['comentario']);

        return $stmt->execute();
    }

    // Eliminar factura
    public function eliminarFactura($id) {
        $stmt = $this->conn->prepare("DELETE FROM facturas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Agregar detalle a la factura
    public function agregarDetalleFactura($detalle) {
        $stmt = $this->conn->prepare("INSERT INTO factura_detalles 
            (factura_id, producto_id, cantidad, precio_unitario, descuento_item, subtotal) 
            VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("iiiddd", 
            $detalle['factura_id'], $detalle['producto_id'], $detalle['cantidad'],
            $detalle['precio_unitario'], $detalle['descuento_item'], $detalle['subtotal']);

        return $stmt->execute();
    }

    // Obtener los detalles de una factura
    public function obtenerDetallesPorFactura($factura_id) {
        $stmt = $this->conn->prepare("SELECT fd.*, p.nombre AS producto_nombre
            FROM factura_detalles fd
            JOIN productos p ON fd.producto_id = p.id
            WHERE fd.factura_id = ?");
        $stmt->bind_param("i", $factura_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>

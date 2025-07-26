<?php
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../models/facturaModel.php";
require __DIR__ . "/../../models/clienteModel.php";

session_start();

$modelo = new FacturaModel();
$productosDisponibles = $modelo->obtenerProductos();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    // Cliente
    $codigo = trim($_POST['codigo']);
    $nombre = trim($_POST['nombre']);

    $cliente = $modelo->buscarClientePorCodigo($codigo);
    if ($cliente) {
        $cliente_id = $cliente['id'];
    } else {
        $cliente_id = $modelo->registrarCliente($codigo, $nombre);
    }

    // Factura
    $numero_recibo = trim($_POST['recibo']);
    $usuario_id = $_SESSION['user']['id'] ?? 1;
    $comentario = trim($_POST['comentario']);
    $total = floatval($_POST['total']);
    $metodo_pago = $_POST['metodo_pago'] ?? 'efectivo';

    $factura_id = $modelo->registrarFactura($numero_recibo, $cliente_id, $usuario_id, $total, $total, $metodo_pago, $comentario);

    // Detalles
    foreach ($_POST['productos'] as $prod) {
        $modelo->registrarDetalle($factura_id, $prod['id'], $prod['cantidad'], $prod['precio'], $prod['cantidad'] * $prod['precio']);
        $modelo->actualizarStock($prod['id'], $prod['cantidad']);
    }

    echo "<script>alert('Venta guardada correctamente');window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Ventas - La Rubia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="bg-primary text-white text-center rounded-4 p-4 mb-4 shadow">
            <h1 class="mb-0">🏪 SISTEMA DE VENTAS</h1>
            <p class="mb-0">LA RUBIA</p>
        </div>

        <form method="post" id="venta-form" class="bg-white p-4 rounded-4 shadow">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label">📅 Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">🧾 Nº Recibo</label>
                    <input type="text" name="recibo" class="form-control" value="REC-<?= rand(100, 999) ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label">🔢 Código Cliente</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">👤 Nombre Cliente</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="mb-3">🛒 Lista de Artículos Vendidos</h4>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="products-table">
                        <thead class="table-primary">
                            <tr>
                                <th>ARTÍCULO</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO UNIT.</th>
                                <th>TOTAL</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody id="products-body">
                            <tr>
                                <td>
                                    <select name="productos[0][id]" class="form-select product-select" onchange="updatePrice(this, 0)">
                                        <option value="">Seleccione...</option>
                                        <?php foreach($productosDisponibles as $prod): ?>
                                            <option value="<?= $prod['id'] ?>" data-precio="<?= $prod['precio_venta'] ?>">
                                                <?= htmlspecialchars($prod['nombre']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="number" name="productos[0][cantidad]" class="form-control" value="1" min="1" onchange="updateTotal(0)"></td>
                                <td><input type="number" name="productos[0][precio]" class="form-control" value="0" readonly></td>
                                <td><span class="fw-bold text-success" id="total-0">RD$0.00</span></td>
                                <td><button type="button" class="btn btn-info" onclick="addRow()">➕</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <div class="me-3 fw-bold">TOTAL A PAGAR:</div>
                    <div class="fs-4 fw-bold text-primary" id="grand-total">RD$0.00</div>
                    <input type="hidden" name="total" id="input-grand-total">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">💬 Comentario</label>
                <textarea name="comentario" class="form-control" rows="2">Pagó en efectivo</textarea>
            </div>

            <div class="d-flex gap-3 justify-content-center">
                <button type="submit" name="guardar" class="btn btn-primary px-4">💾 Guardar e Imprimir</button>
                <button type="button" class="btn btn-secondary px-4" onclick="cancelTransaction()">❌ Cancelar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (opcional, para componentes interactivos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let rowCount = 1;
        const productos = <?= json_encode($productosDisponibles) ?>;

        function addRow() {
            const tbody = document.getElementById('products-body');
            const idx = rowCount++;
            const row = document.createElement('tr');

            let options = '<option value="">Seleccione...</option>';
            productos.forEach(prod => {
                options += `<option value="${prod.id}" data-precio="${prod.precio_venta}">${prod.nombre}</option>`;
            });

            row.innerHTML = `
                <td><select name="productos[${idx}][id]" class="form-select" onchange="updatePrice(this, ${idx})">${options}</select></td>
                <td><input type="number" name="productos[${idx}][cantidad]" class="form-control" value="1" min="1" onchange="updateTotal(${idx})"></td>
                <td><input type="number" name="productos[${idx}][precio]" class="form-control" value="0" readonly></td>
                <td><span class="fw-bold text-success" id="total-${idx}">RD$0.00</span></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">❌</button></td>
            `;
            tbody.appendChild(row);
        }

        function removeRow(btn) {
            btn.closest('tr').remove();
            updateGrandTotal();
        }

        function updatePrice(select, idx) {
            const precio = select.selectedOptions[0].getAttribute('data-precio') || 0;
            document.querySelector(`[name="productos[${idx}][precio]"]`).value = precio;
            updateTotal(idx);
        }

        function updateTotal(idx) {
            const cantidad = parseFloat(document.querySelector(`[name="productos[${idx}][cantidad]"]`).value) || 0;
            const precio = parseFloat(document.querySelector(`[name="productos[${idx}][precio]"]`).value) || 0;
            const total = cantidad * precio;
            document.getElementById(`total-${idx}`).innerText = 'RD$' + total.toFixed(2);
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('span[id^="total-"]').forEach(el => {
                total += parseFloat(el.textContent.replace('RD$', '')) || 0;
            });
            document.getElementById('grand-total').textContent = 'RD$' + total.toFixed(2);
            document.getElementById('input-grand-total').value = total.toFixed(2);
        }

        function cancelTransaction() {
            if (confirm('¿Seguro que deseas cancelar?')) {
                document.getElementById('venta-form').reset();
                document.getElementById('grand-total').textContent = 'RD$0.00';
                document.getElementById('input-grand-total').value = '0.00';
                document.querySelectorAll('#products-body tr:not(:first-child)').forEach(e => e.remove());
                rowCount = 1;
            }
        }

        document.querySelector('.product-select').addEventListener('change', function() {
            updatePrice(this, 0);
        });
    </script>
</body>
</html>

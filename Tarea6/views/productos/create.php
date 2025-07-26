<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../models/productModel.php";
require_once __DIR__ . "/../../models/categoriaModel.php";

$categoriaModel = new CategoriaModel();
$categorias = $categoriaModel->obtenerCategorias();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio_costo = $_POST["costo"];
    $precio_venta = $_POST["precio_venta"];
    $stock_actual = $_POST["stock"];
    $stock_minimo = $_POST["stock_minimo"];
    $categoria_id = $_POST["categoria_id"];

    $productModel = new ProductModel();
    if ($productModel->crearProducto($codigo, $nombre, $descripcion, $precio_costo, $precio_venta, $stock_actual, $stock_minimo, $categoria_id)) {
        header("Location: /Tareas-php/Tarea6/views/productos/index.php");
        exit();
    } else {
        $error = "Error al crear el producto.";
    }
}

?>

<form action="create.php" method="post">
    <div>
        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" required>
    </div>
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
    </div>
    <div>
        <label for="costo">Costo de compra:</label>
        <input type="number" id="costo" name="costo" step="0.01" required>
    </div>
    <div>
        <label for="precio_venta">Precio de venta:</label>
        <input type="number" id="precio_venta" name="precio_venta" step="0.01" required>
    </div>
    <div>
        <label for="stock">Stock actual:</label>
        <input type="number" id="stock" name="stock" required>
    </div>
    <div>
        <label for="stock_minimo">Stock minimo:</label>
        <input type="number" id="stock_minimo" name="stock_minimo" required>
    </div>
    <div>
        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>
            <option value="">Seleccionar categoría</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>"><?php echo htmlspecialchars($categoria['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <button type="submit">Crear Producto</button>
        <a href="index.php">Cancelar</a>
    </div>
</form>
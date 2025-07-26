<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../models/productModel.php";
require_once __DIR__ . "/../../models/categoriaModel.php";

$productModel = new ProductModel();
$productos = $productModel->obtenerProductos();

$categoriaModel = new CategoriaModel();
$categorias = $categoriaModel->obtenerCategorias();

?>

<table>
    <div>
        <h1>Productos</h1>
        <a href="create.php">Crear Nuevo Producto</a>
    </div>
    <div>
        <thead>
            <th>
                <tr>
                    <td>Codigo</td>
                    <td>Nombre</td>
                    <td>Descripción</td>
                    <td>Costo</td>
                    <td>Precio de Venta</td>
                    <td>Stock Actual</td>
                    <td>Stock Mínimo</td>
                    <td>Categoría</td>
                    <td>Acciones</td>
                </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto['codigo']); ?></td>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($producto['precio_costo']); ?></td>
                <td><?php echo htmlspecialchars($producto['precio_venta']); ?></td>
                <td><?php echo htmlspecialchars($producto['stock_actual']); ?></td>
                <td><?php echo htmlspecialchars($producto['stock_minimo']); ?></td>
                <td><?php echo htmlspecialchars($producto['categoria_nombre']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $producto['id']; ?>">Editar</a>
                    <a href="delete.php?id=<?php echo $producto['id']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </div>
</table>
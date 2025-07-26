<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../models/categoriaModel.php";

$categoriaModel = new CategoriaModel();
$categorias = $categoriaModel->obtenerCategorias();

?>
<div>
    <div>
        <h1>Categorías</h1>
        <a href="create.php">Crear Nueva Categoría</a>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($categoria['id']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['descripcion']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $categoria['id']; ?>">Editar</a>
                            <a href="delete.php?id=<?php echo $categoria['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>
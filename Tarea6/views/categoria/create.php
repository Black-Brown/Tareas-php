<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../models/categoriaModel.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];

    $categoriaModel = new CategoriaModel();
    if ($categoriaModel->crearCategoria($nombre, $descripcion)) {
        header("Location: /Tareas-php/Tarea6/views/categoria/index.php");
        exit();
    } else {
        $error = "Error al crear la categoría.";
    }
}


?>
<form action="create.php" method="post">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
    </div>
    <div>
        <button type="submit">Crear Categoria</button>
    </div>
</form>

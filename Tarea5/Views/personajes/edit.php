<?php
define('tabs', 'Personajes');
require('../../libs/index.php');
require_once(__DIR__ . '/../../config/db_config.php');
require_once(__DIR__ . '/../../Models/personaje.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $tipo = $_POST['tipo'];
    $nivel = $_POST['nivel'];
    $foto = $_POST['foto'];


    if(empty($foto)) {
        $foto = $foto_actual;
    }

    $personajeModel = new Personaje();
    if($personajeModel->editarPersonaje($id, $nombre, $tipo, $color, $nivel, $foto)) {
        header("Location: Index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar el personaje.</div>";
    }
} else {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $personajeModel = new Personaje();
        $personaje = $personajeModel->obtenerPersonajePorId($id);
    } else {
        header("Location: Index.php");
        exit();
    }
}

Plantilla::aplicar();
?>

<div class="container mt-5">
    <h2 class="mt-4">Editar Personaje</h2>
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $personaje['id']; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $personaje['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color caracteristico</label>
            <input type="text" class="form-control" id="color" name="color" value="<?php echo $personaje['color']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $personaje['tipo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel</label>
            <input type="number" class="form-control" id="nivel" name="nivel" value="<?php echo $personaje['nivel']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="text" class="form-control" id="foto" name="foto" value="<?php echo $personaje['foto']; ?>" required>

            <img src="<?php echo $personaje['foto']; ?>" alt="Foto actual" class="img-thumbnail mt-2" width="100"> 
            <input type="hidden" name="foto_actual" value="<?php echo $personaje['foto']; ?>">
            <div class="form-text">Dejar en blanco si no desea cambiar la foto.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
        </button>
        <a href="Index.php" class="btn btn-secondary">
            <i class="fa-solid fa-xmark"></i> Cancelar
        </a>
    </form>
</div>
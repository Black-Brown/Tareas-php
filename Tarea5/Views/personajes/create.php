<?php
if (!file_exists(__DIR__ . '/../../config/db_config.php')) {
    header('Location: /../../install.php');
    exit();
} else {
    require_once(__DIR__ . '/../../config/db_config.php');
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        header('Location: /../../install.php');
        exit();
    }
}


define('tabs', 'Personajes');
require('../../libs/index.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $color = $_POST['color'];
    $nivel = $_POST['nivel'];
    $foto = $_POST['foto'];

    $personajeModel = new Personaje();
    if($personajeModel->crearPersonaje($nombre, $tipo, $color, $nivel, $foto)) {
        header("Location: Index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al crear el personaje.</div>";
    }
}


Plantilla::aplicar();
?>

<div class="container mt-5">
    <h2>Crear Personaje</h2>
    <form action="Create.php" method="post" enctype="multipart/form-data">
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
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
        </button>
        <a href="Index.php" class="btn btn-secondary">
            <i class="fa-solid fa-xmark"></i> Cancelar
        </a>
    </form>
</div>
<?php
require_once __DIR__ . '/../../libs/index.php';
require_once __DIR__ . '/../../config/config_db.php';
require_once __DIR__ . '/../../models/visitasModel.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    $model = new visitaModel();

    if($model->crearVisitas($telefono, $nombre, $apellido, $correo)){
        echo '<div class="alert alert-success text-center"> Visitas agregado correctamente</div>';
        plantilla::aplicar();
    } else {
        echo '<div class="alert alert-danger"> error al registrar la visita </div>';
        plantilla::aplicar();
    }

}

plantilla::aplicar();
?>

<form action="crear.php" method="post">
    <div>
        <label class="form-label" for="telefono">Telefono: </label>
        <input class="form-control" type="text" name="telefono" id="telefono" require>
    </div>
    <div>
        <label class="form-label" for="nombre">Nombre: </label>
        <input class="form-control" type="text" name="nombre" id="nombre" require>
    </div>
    <div>
        <label class="form-label" for="apellido">Apellido: </label>
        <input class="form-control" type="text" name="apellido" id="apellido" require>
    </div>
    <div>
        <label class="form-label" for="correo">Correo electronico: </label>
        <input class="form-control" type="text" name="correo" id="correo" require>
    </div>
    <div class="mt-4">
        <button class="btn btn-primary" type="submit">enviar</button>
        <a class="btn btn-warning" href="listar.php">cancelar</a>
    </div>
</form>
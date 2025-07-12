<?php
// se importan los modulos necesarios 
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../models/visitasModel.php';
require_once __DIR__ . '/../../libs/index.php';

// validacion del formulario

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    // se crea una instancia de visitaModelo y se llama la funcion para guardar los datos
    $modelo = new visitaModel();
    if($crear = $modelo->crearVisitas($telefono, $nombre, $apellido, $correo)){
        echo '<div class="alert alert-success mt-3">Registro guardado exitosamente</div>';
        plantilla::aplicar();
    } else {
        echo '<div class="alert alert-warning" >Error al guardar el registro</div>';
        plantilla::aplicar();
    }
}

plantilla::aplicar();
?>
<form class="form-control mt-4" action="crear.php" method="post">
    <!-- input de telfono -->
    <div>
        <label for="telefono">Telefonos: </label>
        <input class="form-control" type="text" name="telefono" id="telefono" require>
    </div>

    <!-- input de nombre -->
    <div>
        <label for="nombre">Nombre: </label>
        <input class="form-control" type="text" name="nombre" id="nombre" require>
    </div>

    <!-- input de apellido -->
    <div>
        <label for="apellido">Apellido: </label>
        <input class="form-control" type="text" name="apellido" id="apellido" require>
    </div>

    <!-- input de correo -->
    <div>
        <label for="correo">Coreo Electronico: </label>
        <input class="form-control" type="text" name="correo" id="correo" require>
    </div>

    <!-- botones -->
    <div class="mt-4">
        <button class="btn btn-primary" type="submit">Enviar</button>
        <a class="btn btn-warning" href="listar.php">Cancelar</a>
    </div>
</form>
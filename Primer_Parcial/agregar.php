<?php
// made by Jheinel Brown Matricula 2024-0017

require('libs/index.php');
require_once('models/pacientes.php');

// validar el formulario 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $edad = $_POST['edad'];
    $motivo = $_POST['motivo'];

    // guardad los datos en el objeto de paciente
    $paciente = new paciente($codigo, $nombre, $apellido, $cedula, $edad, $motivo);

    // crear la carpeta data si no esta en el directorio
    if(!is_dir('data')){
        mkdir('data');
    }

    // configuracion para guardar los datos del objeto paciente en un json
    $ruta = 'data/' . $paciente->codigo . '.json';
    $json = json_encode($paciente);
    file_put_contents($ruta, $json);

    plantilla::aplicar();
    echo '<h3>Paciente registrado exitosamente</h3>';
    echo '<a class="btn btn-primary" href="index.php">volver a inicio</a>';
    exit();

}

plantilla::aplicar();

?>

<div>
    <!-- formulario para agregar paciente -->
    <form action="agregar.php" method="post">
        <!-- codigo -->
        <div>
            <label for="codigo">Codigo: </label>
            <input type="text" name="codigo" require>
        </div>

        <!-- nombre -->
        <div>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" require>
        </div>

        <!-- apellido -->
        <div>
            <label for="apellido">Apellido: </label>
            <input type="text" name="apellido" require>
        </div>

        <!-- cedula -->
        <div>
            <label for="cedula">Cedula: </label>
            <input type="text" name="cedula" require>
        </div>

        <!-- edad -->
        <div>
            <label for="edad">Edad: </label>
            <input type="numbers" name="edad" require>
        </div>

        <!-- motivo -->
        <div>
            <label for="motivo">Motivo: </label>
            <textarea name="motivo" require></textarea>
        </div>

        <!-- enviar datos -->
        <div>
            <input class="btn btn-primary" type="submit" value="Enviar">
            <a class="btn btn-primary" href="index.php">volver a inicio</a>
        </div>
    </form>
</div>
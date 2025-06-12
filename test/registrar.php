<?php
require ('libs\index.php');
require_once ('models\paciente.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $edad = $_POST['edad'];
    $motivo = $_POST['motivo'];

    $paciente = new paciente($codigo, $nombre, $apellido, $cedula, $edad, $motivo);

    if(!is_dir('data')) {
        mkdir('data');
    }

    $path = 'data/' . $paciente->codigo . '.json';
    $json = json_encode($paciente);
    file_put_contents($path, $json);

    plantilla::aplicar();
    echo '<p>paciente agregada exitosamente!</p>';
    echo '<a href="index.php">regresar al incio</a>';
    exit();
}

plantilla::aplicar();
?>

<div>
    <h1>Registrar Paciente</h1>
    <form action="registrar.php" method="post">
        <div>
            <label for="codigo">Codigo: </label>
            <input type="text" name="codigo">   
        </div>
        
        <div>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre">
        </div>
        
        <div>
            <label for="apellido">Apellido: </label>
            <input type="text" name="apellido">
        </div>
        
        <div>
            <label for="cedula">Cedula: </label>
            <input type="text" name="cedula">
        </div>
        
        <div>
            <label for="edad">Edad: </label>
            <input type="number" name="edad">
        </div>

        <div>
            <label for="motivo">Motivo: </label>
            <input type="text" name="motivo">
        </div>

        <div>
            <button type="submit">agregar paciente</button>
            <a href="index.php">regresar al incio</a>
        </div>
    </form>
</div>

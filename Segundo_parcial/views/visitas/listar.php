<?php
// se importan los modulos necesarios 
define('tabs', 'listar');
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../models/visitasModel.php';
require_once __DIR__ . '/../../libs/index.php';

plantilla::aplicar();

// se dos variables donde se utilizan para iniciar la clase del modelo y obtener la funcion
$modelo = new visitaModel();
$visita = $modelo->obtenerVisitas();
?>

<div class="d-flex justify-content-between align-items-center mt-4 mb-4 ">
    <h1>Listas de visitas</h1>
    <a class="btn btn-primary" href="crear.php">Ingresar Visitas</a>
</div>
<table class="table table-striped table-bordered">
    <thead class="table-info">
        <tr>
            <td>Telefonos</td>
            <td>Nombres</td>
            <td>Apellidos</td>
            <td>Correo Electronicos</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($visita as $v):?>
            <tr>
                <td><?= $v['telefono']?></td>
                <td><?= $v['nombre']?></td>
                <td><?= $v['apellido']?></td>
                <td><?= $v['correo_electronico']?></td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>




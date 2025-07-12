<?php
define('tabs', 'listas');

require_once __DIR__ . '/../../libs/index.php';
require_once __DIR__ . '/../../config/config_db.php';
require_once __DIR__ . '/../../models/visitasModel.php';

$model = new visitaModel();
$visitas = $model->obtenerVisitas();

plantilla::aplicar();
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h3>lista de visitas</h3>
        <a class="btn btn-primary"href="crear.php">agregar nuevas visitas</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-info">
            <tr>
                <td>Telefonos</td>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Correos</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($visitas as $v):?>
            <tr>
                <td><?= $v['telefono']?></td>
                <td><?= $v['nombre']?></td>
                <td><?= $v['apellido']?></td>
                <td><?= $v['correo_electronico']?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
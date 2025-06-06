<?php
include('../../libreria/principal.php');
require_once(__DIR__ . '/../../libreria/objeto.php');
define('PAGINA_ACTUAL', 'profesion');


plantilla::aplicar();

$profesiones = Dbx::listar('profesiones');

?>
<div class="container mt-5 d-flex flex-column align-items-center">
    <h1 class="mb-4 text-center">Listado de profesiones</h1>
    <div class="text-center mb-3 w-100">
        <a href="<?= base_url("modulos/profesiones/editar.php");?>" class="btn btn-success">Crear Profesión</a>  
    </div>

    <div class="table-responsive w-75">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre de la Profesión</th>
                    <th>Categoría</th>
                    <td>Accion</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profesiones as $profesion): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($profesion->nombre_profesion);?></td>
                        <td><?php echo htmlspecialchars($profesion->categoria);?></td>
                        <td>
                            <a href="<?= base_url("modulos/profesiones/editar.php?codigo={$profesion->idx}");?>" class="btn btn-primary">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('../../libreria/principal.php');
define('PAGINA_ACTUAL', 'personaje');

plantilla::aplicar();

$personajes = Dbx::listar('personaje');

?>
<h3 class="text-center mb-4">Listado de Personajes</h3>
<div class="container mt-5 d-flex flex-column align-items-center">
    <div class="text-center mb-3 w-100">
        <a href="<?= base_url("modulos/personajes/editar.php");?>" class="btn btn-success">Crear Personaje</a>  
    </div>

    <div class="table-responsive w-75">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Profesión</th>
                    <th>Edad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($personajes) && is_array($personajes)): ?>
                    <?php foreach ($personajes as $personaje): ?>
                        <tr>
                            <td>
                                <?php if (!empty($personaje->foto)): ?>
                                    <img src="<?php echo htmlspecialchars($personaje->foto); ?>" alt="Foto de <?php echo htmlspecialchars($personaje->nombre); ?>" style="max-width: 80px; max-height: 80px;">
                                <?php else: ?>
                                    Sin foto
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($personaje->nombre);?></td>
                            <td><?php echo htmlspecialchars($personaje->profesion);?></td>
                            <td>
                                <?php
                                    if (!empty($personaje->fecha_nacimiento)) {
                                        $fecha_nacimiento = new DateTime($personaje->fecha_nacimiento);
                                        $hoy = new DateTime();
                                        $edad = $hoy->diff($fecha_nacimiento)->y;
                                        echo $edad . " años";
                                    } else {
                                        echo "Desconocida";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url("modulos/personajes/editar.php?codigo={$personaje->idx}");?>" class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay personajes registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
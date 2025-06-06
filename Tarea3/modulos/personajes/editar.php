<?php

include('../../libreria/principal.php');
define('PAGINA_ACTUAL', 'personaje');

if($_POST) {
    $personaje = new Personajes($_POST);
    
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        Dbx::guardar('personaje', $codigo, $personaje);
    } else {
        Dbx::guardar('personaje', '', $personaje);
    }
    
    header("Location: " . base_url("modulos/personajes/lista.php"));
    exit;
}

plantilla::aplicar();

$personaje = new Personajes();

if (isset($_GET['codigo'])) {
    $personaje = Dbx::obtener('personaje', $_GET['codigo']);
    if (!$personaje) {
        header("Location: " . base_url("modulos/personjes/lista.php"));
        exit;
    }
} 

?>

<div class="container mt-4" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Editar Personaje</h3>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="<?= $_SERVER['REQUEST_URI'] ?>">
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código de la Profesión</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?= htmlspecialchars($personaje->idx); ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($personaje->nombre ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value="<?= htmlspecialchars($personaje->apellido ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= htmlspecialchars($personaje->fecha_nacimiento ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto (URL)</label>
                    <input type="text" class="form-control" name="foto" id="foto" placeholder="https://ejemplo.com/imagen.jpg" value="<?= htmlspecialchars($personaje->foto ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="profesion" class="form-label">Profesión</label>
                    <select class="form-select" name="profesion" id="profesion" required>
                        <option value="">Seleccione una profesión</option>
                        <?php
                        $profesiones = Dbx::listar('profesiones');
                        foreach ($profesiones as $profesion) {
                            $selected = ($personaje->profesion ?? '') === $profesion->idx ? 'selected' : '';
                            echo "<option value=\"{$profesion->idx}\" $selected>" . htmlspecialchars($profesion->nombre_profesion) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nivel_experiencia" class="form-label">Nivel de Experiencia</label>
                    <input type="number" class="form-control" name="nivel_experiencia" id="nivel_experiencia" value="<?= htmlspecialchars($personaje->nivel_experiencia ?? ''); ?>" min="0" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("modulos/personajes/lista.php"); ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
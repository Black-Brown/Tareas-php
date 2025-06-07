<?php
include('../../libreria/principal.php');
define('PAGINA_ACTUAL', 'profesion');

if($_POST) {
    $profesion = new Profesiones($_POST);
    
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        Dbx::guardar('profesiones', $codigo, $profesion);
    } else {
        Dbx::guardar('profesiones', '', $profesion);
    }
    
    header("Location: " . base_url("modulos/profesiones/lista.php"));
    exit;
}

plantilla::aplicar();

$profesion =  new Profesiones();

if (isset($_GET['codigo'])) {
    $profesion = Dbx::obtener('profesiones', $_GET['codigo']);
    if (!$profesion) {
        header("Location: " . base_url("modulos/profesiones/lista.php"));
        exit;
    }
} 

?>

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><?= isset($_GET['codigo']) ? 'Editar Profesión' : 'Nueva Profesión' ?></h3>
        </div>
        <div class="card-body">
            <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código de la Profesión</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?= htmlspecialchars($profesion->codigo); ?>" <?= isset($_GET['codigo']) ? 'readonly' : '' ?>>
                </div>
                <div class="mb-3">
                    <label for="nombre_profesion" class="form-label">Nombre de la Profesión</label>
                    <input type="text" class="form-control" id="nombre_profesion" name="nombre_profesion" value="<?= htmlspecialchars($profesion->nombre_profesion); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" value="<?= htmlspecialchars($profesion->categoria); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="salario_mensual" class="form-label">Salario Mensual</label>
                    <input type="number" class="form-control" id="salario_mensual" name="salario_mensual" value="<?= htmlspecialchars($profesion->salario_mensual); ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("modulos/profesiones/lista.php"); ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $titulo = "Registrar Obra";?>
<div class="container mt-5">
    <h2>Registrar Obra</h2>
    <form method="post" action="guardar_obra.php">
    <div class="mb-3">
        <label>Código</label>
        <input type="text" class="form-control" name="codigo" required>
    </div>
    <div class="mb-3">
        <label>Foto URL</label>
        <input type="text" class="form-control" name="foto_url">
    </div>
    <div class="mb-3">
        <label>Tipo</label>
        <select class="form-select" name="tipo">
        <option value="Película">Película</option>
        <option value="Serie">Serie</option>
        <option value="Otro">Otro</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion"></textarea>
    </div>
    <div class="mb-3">
        <label>País</label>
        <input type="text" class="form-control" name="pais">
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" class="form-control" name="autor">
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
<?php?>

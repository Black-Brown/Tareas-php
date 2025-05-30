<?php

require('libreria/principal.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge los datos del formulario
    $codigo = $_POST['codigo'];
    $foto_url = $_POST['foto_url'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $pais = $_POST['pais']; 
    $autor = $_POST['autor'];

    // Crea el objeto con los 7 argumentos
    $obra = new obra($codigo, $foto_url, $tipo, $nombre, $descripcion, $pais, $autor);

    if (!is_dir('datos')) {
        mkdir('datos');
    }

    $ruta = 'datos/' . $obra->codigo . '.json';
    $json = json_encode($obra);
    file_put_contents($ruta, $json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra agregada exitosamente!</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al inicio</a>";
    exit();
}

plantilla::aplicar();
?>

<form action="agregar.php" method="post">
    <h2>Agregar Obra</h2>

    <!-- Codigo -->
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo:</label>
        <input type="text" class="form-control"  name="codigo" required>
    </div>
    <!-- Foto -->
    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto URL:</label>
        <input type="text" class="form-control" id="foto_url" name="foto_url" required>
    </div>
    <!-- Tipo -->
    <div>
        <label for="tipo" class="form-label">Tipo:</label>
        <select class="form-select" id="tipo" name="tipo" required>
            <option value="">Seleccione un tipo</option>
            <?php
            foreach (Datos::tipo_de_obra() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?>
        </select>
    </div>
    <!-- Nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <!-- descripcion -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">descripcion:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        
    </div>
    <!-- Pais -->
    <div class="mb-3">
        <label for="pais" class="form-label">Pais</label>
        <input type="text" class="form-control" name="pais" required>
    </div>
    <!-- Autor -->
    <div class="mb-3">
        <label for="autor" class="form-label">Autor:</label>
        <input type="text" class="form-control" id="autor" name="autor" required>

    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Agregar Obra</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php

require('libreria/principal.php');
require_once('libreria/objecto.php'); // Asegúrate que aquí está la clase personaje

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge los datos del formulario
    $codigo = $_POST['codigo'];
    $cedula = $_POST['cedula'];
    $foto_url = $_POST['foto_url'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $habilidades = $_POST['habilidades'];
    $comida_favorita = $_POST['comida_favorita'];

    // Carga la obra
    $ruta = 'datos/' . $codigo . '.json';
    if (file_exists($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);

        // Crea el personaje (ajusta los argumentos según tu clase)
        $nuevo_personaje = new personaje(
            $cedula,
            $foto_url,
            $nombre,
            $apellido,
            $fecha_nacimiento,
            $sexo,
            $habilidades,
            $comida_favorita
        );

        // Agrega el personaje al array de la obra
        if (!isset($obra->personajes)) {
            $obra->personajes = [];
        }
        $obra->personajes[] = $nuevo_personaje;

        // Guarda la obra actualizada
        file_put_contents($ruta, json_encode($obra));

        plantilla::aplicar();
        echo "<div class='alert alert-success'>Personaje agregado exitosamente!</div>";
        echo "<a href='personaje.php?codigo=" . urlencode($codigo) . "' class='btn btn-primary'>Volver a la obra</a>";
        exit();
    } else {
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Obra no encontrada.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver al inicio</a>";
        exit();
    }
}

// Si es GET, muestra el formulario
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $ruta = 'datos/' . $codigo . '.json';
    if (file_exists($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    } else {
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Obra no encontrada.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver al inicio</a>";
        exit();
    }
} else {
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>Error al cargar la obra.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al inicio</a>";
    exit();
}

plantilla::aplicar();
?>

<form action="agregar_personaje.php" method="post">
    <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($codigo); ?>">
    <h2>Agregar Personaje</h2>
    <div class="mb-3">
        <label for="cedula" class="form-label">Cédula:</label>
        <input type="text" class="form-control" name="cedula" required>
    </div>
    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto URL:</label>
        <input type="text" class="form-control" name="foto_url" required>
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido:</label>
        <input type="text" class="form-control" name="apellido" required>
    </div>
    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" name="fecha_nacimiento" required>
    </div>
    <div class="mb-3">
        <label for="sexo" class="form-label">Sexo:</label>
        <select class="form-select" name="sexo" required>
            <option value="">Seleccione un sexo</option>
            <?php
            foreach (Datos::tipo_de_personaje() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="habilidades" class="form-label">Habilidades:</label>
        <textarea class="form-control" name="habilidades" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="comida_favorita" class="form-label">Comida Favorita:</label>
        <input type="text" class="form-control" name="comida_favorita" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Agregar Personaje</button>
        <a href="personaje.php?codigo=<?php echo urlencode($codigo); ?>" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
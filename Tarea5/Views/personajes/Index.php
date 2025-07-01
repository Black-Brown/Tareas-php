<?php
if (!file_exists(__DIR__ . '/../../config/db_config.php')) {
    header('Location: /install.php');
    exit();
} else {
    require_once(__DIR__ . '/../../config/db_config.php');
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        header('Location: /install.php');
        exit();
    }
}

define('tabs', 'Personajes');
require('../../libs/index.php');
require_once(__DIR__ . '/../../Models/personaje.php');

$personajeModel = new Personaje();
$personajes = $personajeModel->obtenerPersonajes();

Plantilla::aplicar();
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fas fa-users"></i> Lista de Personajes</h2>
        <a href="create.php" class="btn btn-success mt-3">
            <i class="fas fa-plus"></i> Agregar Personaje
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-image"></i> Foto</th>
                <th><i class="fas fa-user"></i> Nombre</th>
                <th><i class="fas fa-shapes"></i> Tipo</th>
                <th><i class="fas fa-palette"></i> Color caracteristico</th>
                <th><i class="fas fa-level-up-alt"></i> Nivel</th>
                <th><i class="fas fa-cogs"></i> Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personajes as $personaje): ?>
                <tr>
                    <td><?php echo $personaje['id']; ?></td>
                    <td><img src="<?php echo $personaje['foto']; ?>" alt="Foto" height="200" width="200" style="object-fit: cover;"></td>
                    <td><?php echo $personaje['nombre']; ?></td>
                    <td><?php echo $personaje['tipo']; ?></td>
                    <td><?php echo $personaje['color']; ?></td>
                    <td><?php echo $personaje['nivel']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $personaje['id']; ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="details.php?id=<?php echo $personaje['id']; ?>" class="btn btn-primary">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="download_pdf.php?id=<?= urlencode($personaje['id']) ?>" class="btn btn-warning" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>
                        </a>
                        <a href="delete.php?id=<?php echo $personaje['id']; ?>" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> 
                        </a>                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
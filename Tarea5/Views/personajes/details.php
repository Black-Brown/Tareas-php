<?php
if (!file_exists(__DIR__ . '/../../config/db_config.php')) {
    header('Location: /../../install.php');
    exit();
} else {
    require_once(__DIR__ . '/../../config/db_config.php');
    try {
        mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        header('Location: /../../install.php');
        exit();
    }
}

define('tabs', 'Personajes');
require('../../libs/index.php');
require_once(__DIR__ . '/../../Models/personaje.php');

$personajeModel = new Personaje();

$id = $_GET['id'] ?? null;
$personaje = null;
if ($id) {
    $personaje = $personajeModel->obtenerPersonajePorId($id);
}

Plantilla::aplicar();
?>

<div class="container mt-5">
    <?php if ($personaje): ?>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <img src="<?= htmlspecialchars($personaje['foto']) ?>" class="card-img-top rounded-top-4" alt="Foto de <?= htmlspecialchars($personaje['nombre']) ?>" style="object-fit: cover; height: 300px;">
                    <div class="card-body bg-light rounded-bottom-4">
                        <h3 class="card-title text-center mb-3"><?= htmlspecialchars($personaje['nombre']) ?></h3>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item"><strong>Tipo:</strong> <?= htmlspecialchars($personaje['tipo']) ?></li>
                            <li class="list-group-item"><strong>Color característico:</strong> <?= htmlspecialchars($personaje['color']) ?></li>
                            <li class="list-group-item"><strong>Nivel:</strong> <?= htmlspecialchars($personaje['nivel']) ?></li>
                        </ul>
                        <div class="d-grid">
                            <a href="Index.php" class="btn btn-primary btn-lg rounded-pill">
                                <i class="fa-solid fa-house"></i> Volver a la lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger mt-5 text-center rounded-4 shadow-sm">No se encontró el personaje.</div>
    <?php endif; ?>
</div>
<?php
define('tabs', 'Inicio');
require('libs/index.php');
require_once(__DIR__ . '/config/db_config.php');
require_once(__DIR__ . '/Models/personaje.php');

$personajeModel = new Personaje();
$personajes = $personajeModel->obtenerPersonajes();

Plantilla::aplicar();
?>

<div class="container mt-5 text-center">
    <h1>Bienvenido a la Tarea 5</h1>
    <div class="row justify-content-center">
        <?php foreach ($personajes as $personaje): ?>
            <div class="col-md-4 mb-4">
                <div class="card card-personaje h-100 shadow-sm border-0">
                    <?php if (!empty($personaje['foto'])): ?>
                        <img 
                            src="<?php echo htmlspecialchars($personaje['foto']); ?>" 
                            class="card-img-top rounded-circle mx-auto mt-3"
                            alt="Imagen de <?php echo htmlspecialchars($personaje['nombre']); ?>"
                            style="width: 150px; height: 150px; object-fit: cover;"
                        >
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($personaje['nombre']); ?></h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($personaje['tipo']); ?></p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="Views/personajes/details.php?id=<?php echo $personaje['id']; ?>" class="btn btn-primary btn-sm">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
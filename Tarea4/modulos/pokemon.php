<?php
define('tabs', 'Pokemon');
require("../libs/index.php");

$pokemon = null;
$nombre = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = strtolower(trim($_POST['nombre']));
    $url = "https://pokeapi.co/api/v2/pokemon/" . urlencode($nombre);
    $respuesta = file_get_contents($url);

    if ($respuesta !== false){
        $data = json_decode($respuesta, true);
        $pokemon = [
            'foto' => $data['sprites']['front_default'],
            'experiencia' => $data['base_experience'],
            'habilidades' => array_map(function($habilidad) {
                return $habilidad['ability']['name'];
            }, $data['abilities']),
            'sonido' => $data['cries']['latest'] ?? $data['cries']['legacy'] ?? null,
        ];
    } else {
        $error = "Error al conectar con la API de Pokémon.";
    }
}

plantilla::aplicar();

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Pokémon</h4>
                </div>
                <div class="card-body">
                    <form action="pokemon.php" method="post">
                        <div class="form-group mb-3">
                            <label for="nombre" class="fw-bold">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" <?php echo 'value="' . htmlspecialchars($nombre) . '"'; ?> required placeholder="Escribe un nombre...">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i> Buscar Pokémon
                            </button>
                        </div>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($pokemon): ?>
                        <div class="alert alert-info mt-4 text-center">
                            <h5><?= htmlspecialchars(ucwords($pokemon['nombre'])) ?></h5>
                            <img src="<?= $pokemon['foto'] ?>" alt="foto pokemon" style="width:100px;">
                            <div><strong>Experiencia:</strong> <?= htmlspecialchars($pokemon['experiencia']) ?></div>
                            <div><strong>Habilidades:</strong> <?= htmlspecialchars(implode(', ', $pokemon['habilidades'])) ?></div>
                            <?php if ($pokemon['sonido']): ?>
                                <audio controls>
                                    <source src="<?= $pokemon['sonido'] ?>" type="audio/mpeg">
                                    Tu navegador no soporta el elemento de audio.
                                </audio>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
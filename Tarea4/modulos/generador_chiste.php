<?php
define('tabs', 'Risa');
require("../libs/index.php");

$chiste = null;
$error = '';

$url = "https://official-joke-api.appspot.com/random_joke";
$respuesta = @file_get_contents($url);

if ($respuesta !== false) {
    $data = json_decode($respuesta, true);
    if (isset($data['setup']) && isset($data['punchline'])) {
        $chiste = [
            'setup' => $data['setup'],
            'punchline' => $data['punchline']
        ];
    } else {
        $error = "No se pudo obtener un chiste en este momento.";
    }
} else {
    $error = "Error al conectar con la API de chistes.";
}

plantilla::aplicar();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-warning">
                <div class="card-header bg-warning text-dark text-center">
                    <h4 class="mb-0"><i class="fa fa-face-laugh"></i> Generador de Chistes</h4>
                </div>
                <div class="card-body text-center">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($chiste): ?>
                        <div style="font-size:2em">🤣</div>
                        <h5 class="mt-3"><?= htmlspecialchars($chiste['setup']) ?></h5>
                        <p class="lead text-primary"><?= htmlspecialchars($chiste['punchline']) ?></p>
                        <div class="d-grid">
                            <a href="generador_chiste.php" class="btn btn-warning mt-3"><i class="fa fa-redo"></i> Otro chiste</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
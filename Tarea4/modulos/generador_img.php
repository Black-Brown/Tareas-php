<?php
define('tabs', 'Imagenes');
require("../libs/index.php");

$api_key = "hTHoM9Job8P9Hmm2nJ3tqtsI2klWVnQh5FRPShMO8T0";
$palabra = '';
$imagen = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $palabra = trim($_POST['palabra']);
    if ($palabra !== '') {
        $url = "https://api.unsplash.com/photos/random?query=" . urlencode($palabra) . "&client_id=" . $api_key;
        $respuesta = @file_get_contents($url);

        if ($respuesta !== false) {
            $data = json_decode($respuesta, true);
            if (isset($data['urls']['regular'])) {
                $imagen = $data['urls']['regular'];
            } else {
                $error = "No se encontró imagen para esa palabra clave.";
            }
        } else {
            $error = "Error al conectar con la API de imágenes.";
        }
    } else {
        $error = "Por favor, ingresa una palabra clave.";
    }
}

plantilla::aplicar();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-info">
                <div class="card-header bg-secondary text-center text-white">
                    <h4 class="mb-0"><i class="fa fa-image"></i> Generador de Imágenes con IA</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="generador_img.php">
                        <div class="mb-3">
                            <label for="palabra" class="form-label fw-bold">Palabra clave:</label>
                            <input type="text" class="form-control" id="palabra" name="palabra" required placeholder="Ej: cat, beach, car..." value="<?= htmlspecialchars($palabra) ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-magic"></i> Generar Imagen
                            </button>
                        </div>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($imagen): ?>
                        <div class="mt-4 text-center">
                            <img src="<?= htmlspecialchars($imagen) ?>" alt="Imagen generada" class="img-fluid rounded shadow" style="max-height:400px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
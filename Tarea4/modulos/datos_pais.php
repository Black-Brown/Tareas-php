<?php
define('tabs', 'País');
require("../libs/index.php");

$pais = '';
$datos = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pais = trim($_POST['pais']);
    if ($pais !== '') {
        $url = "https://restcountries.com/v3.1/name/" . urlencode($pais);
        $respuesta = file_get_contents($url);

        if ($respuesta !== false) {
            $data = json_decode($respuesta, true);
            if (is_array($data) && isset($data[0])) {
                $info = $data[0];
                $bandera = $info['flags']['png'] ?? '';
                $capital = $info['capital'][0] ?? 'Desconocida';
                $poblacion = $info['population'] ?? 'Desconocida';
                // Moneda
                $moneda = 'Desconocida';
                $simbolo = '';
                if (isset($info['currencies']) && is_array($info['currencies'])) {
                    $curr = array_values($info['currencies'])[0];
                    $moneda = $curr['name'] ?? 'Desconocida';
                    $simbolo = $curr['symbol'] ?? '';
                }
                $datos = [
                    'bandera' => $bandera,
                    'capital' => $capital,
                    'poblacion' => $poblacion,
                    'moneda' => $moneda,
                    'simbolo' => $simbolo
                ];
            } else {
                $error = "No se encontró información para ese país.";
            }
        } else {
            $error = "Error al conectar con la API de países.";
        }
    } else {
        $error = "Por favor, ingrese el nombre de un país.";
    }
}

plantilla::aplicar();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-info">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0"><i class="fa fa-globe"></i> Datos de un País</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="datos_pais.php">
                        <div class="mb-3">
                            <label for="pais" class="form-label fw-bold">Nombre del país:</label>
                            <input type="text" class="form-control" id="pais" name="pais" required placeholder="Ej: Dominican Republic" value="<?= htmlspecialchars($pais) ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($datos): ?>
                        <div class="alert alert-info mt-4 text-center">
                            <img src="<?= htmlspecialchars($datos['bandera']) ?>" alt="Bandera" style="width:120px; border:1px solid #ccc; border-radius:8px;">
                            <h5 class="mt-3"><?= htmlspecialchars(ucwords($pais)) ?></h5>
                            <p><strong>Capital:</strong> <?= htmlspecialchars($datos['capital']) ?></p>
                            <p><strong>Población:</strong> <?= number_format($datos['poblacion']) ?></p>
                            <p><strong>Moneda:</strong> <?= htmlspecialchars($datos['moneda']) ?> <?= htmlspecialchars($datos['simbolo']) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
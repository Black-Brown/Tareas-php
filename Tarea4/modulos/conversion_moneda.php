<?php
define('tabs', 'Moneda');
require("../libs/index.php");

$cantidad = '';
$resultado = [];
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cantidad = floatval($_POST['cantidad']);
    if($cantidad > 0){
        $url = "https://api.exchangerate-api.com/v4/latest/USD";
        $respuesta = file_get_contents($url);

        if ($respuesta !== false) {
            $data = json_decode($respuesta, true);
            if (isset($data['rates']['DOP'])) {
                $resultados['DOP'] = $cantidad * $data['rates']['DOP'];
                $resultados['EUR'] = $cantidad * $data['rates']['EUR'];
                $resultados['MXN'] = $cantidad * $data['rates']['MXN'];
                $resultados['BRL'] = $cantidad * $data['rates']['BRL'];
            } else {
                $error = "No se pudo obtener la tasa de cambio.";
            }
        } else {
            $error = "Error al conectar con la API de tasas de cambio.";
        }
    } else {
        $error = "Ingrese una cantidad válida en USD.";
    }
}


plantilla::aplicar();

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-success">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0"><i class="fa fa-coins"></i> Conversión de Moneda</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="conversion_moneda.php">
                        <div class="mb-3">
                            <label for="cantidad" class="form-label fw-bold">Cantidad en USD ($):</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="cantidad" name="cantidad" required value="<?= htmlspecialchars($cantidad) ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"><i class="fa fa-exchange-alt"></i> Convertir</button>
                        </div>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($resultados): ?>
                        <div class="alert alert-info mt-4">
                            <h5>Resultados:</h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fa-solid fa-dollar-sign"></i> <strong>USD:</strong> <?= number_format($cantidad, 2) ?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa-solid fa-peso-sign"></i> <strong>DOP:</strong> <?= number_format($resultados['DOP'], 2) ?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa-solid fa-euro-sign"></i> <strong>EUR:</strong> <?= number_format($resultados['EUR'], 2) ?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa-solid fa-dollar-sign"></i> <strong>MXN:</strong> <?= number_format($resultados['MXN'], 2) ?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa-solid fa-dollar-sign"></i> <strong>BRL:</strong> <?= number_format($resultados['BRL'], 2) ?>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
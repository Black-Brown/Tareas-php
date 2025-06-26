<?php
define('tabs', 'Clima');
require("../libs/index.php");

$ciudad = 'Santo Domingo';
$clima = null;
$temperatura = null;
$icono = '';
$emoji = '';
$error = '';

$API_KEY = '8b47042393968e79ccd5b38c188247dd';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ciudad = trim($_POST['ciudad']);
}

$url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudad) . "&appid=" . $API_KEY . "&units=metric";
$respuesta = file_get_contents($url);

if ($respuesta !== false) {
    $data = json_decode($respuesta, true);
    if (isset($data['weather'][0]['description'])) {
        $clima = $data['weather'][0]['description'];
        $temperatura = $data['main']['temp'];
        $icono = "https://openweathermap.org/img/wn/" . $data['weather'][0]['icon'] . "@2x.png";

        switch ($clima) {
            case 'clear sky':
                $emoji = '☀️';
                break;
            case 'few clouds':
                $emoji = '🌤️';
                break;
            case 'scattered clouds':
                $emoji = '⛅';
                break;
            case 'broken clouds':
                $emoji = '☁️';
                break;
            case 'shower rain':
                $emoji = '🌧️';
                break;
            case 'rain':
                $emoji = '🌧️';
                break;
            case 'thunderstorm':
                $emoji = '⛈️';
                break;
            case 'snow':
                $emoji = '❄️';
                break;
            case 'mist':
                $emoji = '🌫️';
                break;
            default:
                $emoji = '';
        }
    } else {
        $error = "No se pudo obtener la información del clima para la ciudad especificada.";
    }
} else {
    $error = "Error al conectar con la API de OpenWeatherMap.";
}

plantilla::aplicar();

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-center">
                    <h4 class="mb-0"><i class="fa-solid fa-cloud-sun"></i> Predicción del Clima</h4>
                </div>
                <div class="card-body">
                    <form action="prediccion_clima.php" method="post">
                        <div class="form-group mb-3">
                            <label for="ciudad" class="fw-bold">Ciudad:</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required placeholder="Escribe el nombre de la ciudad..." <?php echo 'value="' . htmlspecialchars($ciudad) . '"'; ?>>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-cloud"></i> Consultar Clima
                            </button>
                        </div>
                        <?php if ($error): ?>
                            <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                        <?php elseif ($temperatura !== null): ?>
                            <div class="alert alert-info mt-4 text-center">
                                <h5><?= htmlspecialchars(ucwords($ciudad)) ?> Republica Dominicana</h5>
                                <img src="<?= $icono ?>" alt="icono clima" style="width:80px;">
                                <div style="font-size:2em"><?= $emoji ?> <?= htmlspecialchars(ucfirst($clima)) ?></div>
                                <div class="mt-2"><strong>Temperatura:</strong> <?= htmlspecialchars($temperatura) ?> °C</div>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
define('tabs', 'Edad');
require("../libs/index.php");

$nombre = '';
$edad = null;
$categoria = '';
$emoji = '';
$img = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $url = "https://api.agify.io/?name=" . urlencode($nombre);
    $respuesta = file_get_contents($url);

    if ($respuesta !== false) {
        $data = json_decode($respuesta, true);
        if (isset($data['age'])) {
            $edad = $data['age'];
            if ($edad < 18) {
                $categoria = 'joven';
                $emoji = '👶';
                $img = 'https://img.freepik.com/foto-gratis/retrato-hombre-foding-sus-manos_171337-15873.jpg';
            } elseif ($edad < 60) {
                $categoria = 'adulto';
                $emoji = '🧑';
                $img = 'https://img.freepik.com/foto-gratis/retrato-hombre-mediana-edad-seguro_23-2149051743.jpg?t=st=1750868943~exp=1750872543~hmac=03fdf3a9b11328bf9603e30e9c22e1e57297ad14ec470a847628253699b7edab&w=1380';
            } else {
                $categoria = 'anciano';
                $emoji = '👨‍🦳';
                $img = 'https://img.freepik.com/foto-gratis/vista-frontal-anciano-sentado-banco_23-2150493103.jpg?t=st=1750868825~exp=1750872425~hmac=d5909e2e76b7cc5b682c56cceb79cdc61d552ba39564cade8806ed5efb88f6db&w=1380';
            }
        } else {
            $error = "No se puede predecir la edad para este nombre.";
        }
    } else {
        $error = "Error al conectar con el servicio de predicción de edad.";
    }
}

plantilla::aplicar();

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Predicción de Edad</h4>
                </div>
                <div class="card-body">
                    <form action="prediccion_edad.php" method="post">
                        <div class="form-group mb-3">
                            <label for="nombre" class="fw-bold">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required <?php echo 'value="' . htmlspecialchars($nombre) . '"'; ?>>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-gear"></i> Predecir Edad
                            </button>
                        </div>
                    </form>

                    <?php if ($edad !== null): ?>
                        <div class="alert alert-info mt-4 text-center">
                            <strong>Edad:</strong> <?php echo htmlspecialchars($edad); ?> años <br>
                            <strong>Categoría:</strong> <?php echo htmlspecialchars($categoria); ?> <?php echo $emoji; ?><br>
                            <img src="<?php echo $img; ?>" alt="Imagen representativa" class="img-fluid mt-2" style="max-width: 100%; height: 300px;">
                        </div>
                    <?php elseif ($error): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

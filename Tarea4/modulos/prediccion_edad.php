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
                $img = 'https://img.freepik.com/foto-gratis/sonriente-pareja-joven-sentado-bicicleta-contra-fondo-blanco_23-2147893306.jpg?t=st=1750870347~exp=1750873947~hmac=7474fc01f375923567b34182bb6e592cc85204471111fe315d84ddaf7c90742b&w=1380';
            } elseif ($edad < 60) {
                $categoria = 'adulto';
                $emoji = '🧑';
                $img = 'https://img.freepik.com/foto-gratis/senior-pareja-navidad-disparo-primer-plano_23-2148333667.jpg';
            } else {
                $categoria = 'anciano';
                $emoji = '👨‍🦳';
                $img = 'https://img.freepik.com/foto-gratis/pareja-ancianos_23-2148138522.jpg?t=st=1750870305~exp=1750873905~hmac=01972463897c3c1296ffb591a893b53ac63c9e41d95d829f2815ec74a76f2f74&w=1380';
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
                            <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Escribe un nombre..." <?php echo 'value="' . htmlspecialchars($nombre) . '"'; ?>>
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
                            <img src="<?php echo $img; ?>" alt="Imagen representativa" class="img-fluid mt-2" style="max-width: 100%; height: 400px;">
                        </div>
                    <?php elseif ($error): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

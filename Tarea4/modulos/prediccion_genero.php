<?php
define('tabs', 'Genero');
require("../libs/index.php");


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre =$_POST['nombre'];

    $url = "https://api.genderize.io/?name=" . urlencode($nombre);
    $respuesta = file_get_contents($url);

    if ($respuesta !== false) {
        $data = json_decode($respuesta, true);
        if (isset($data['gender'])) {
            $genero = $data['gender'];
            $probabilidad = $data['probability'];
        } else {
            $error = "NO se puede predecir el genero para este nombre.";
        }
    } else {
        $error = "Error al conectar con el servicio de predicción de género.";
    }
}

plantilla::aplicar();
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Predicción de Género</h4>
                </div>
                <div class="card-body">
                    <form action="prediccion_genero.php" method="post">
                        <div class="form-group mb-3">
                            <label for="nombre" class="fw-bold">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" <?php echo 'value="' . htmlspecialchars($nombre) . '"'; ?> required placeholder="Escribe un nombre...">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-gear"></i> Predecir Género
                            </button>
                        </div>
                    </form>
                    <?php if ($genero): ?>
                        <?php
                            $alertClass = 'alert-info';
                            if ($genero === 'male') {
                                $alertClass = 'alert-primary';
                            } elseif ($genero === 'female') {
                                $alertClass = 'bg-pink';
                            }
                        ?>
                        <div class="alert <?php echo $alertClass; ?> mt-4 text-center">
                            <strong>Género:</strong> <?php echo htmlspecialchars($genero); ?><br>
                            <strong>Probabilidad:</strong> <?php echo htmlspecialchars($probabilidad * 100) . '%'; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-3 text-center"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.bg-pink { background-color:rgb(238, 117, 173) !important; }
</style>

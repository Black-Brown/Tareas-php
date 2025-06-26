<?php
define('tabs', 'Universidad');
require("../libs/index.php");

$universidad = [];
$error = '';
$pais = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pais = $_POST['pais'];

    if($pais !== ''){
        $url = "http://universities.hipolabs.com/search?country=" . urlencode($pais);
        $respuesta = file_get_contents($url);
         
        if($respuesta !== false){
            $universidad = json_decode($respuesta, true);
            if(empty($universidad)){
                $error = "No se encontraron universidades para el país especificado.";
            }
        } else {
            $error = "Error al conectar con la API de universidades.";
        }
    } else {
        $error = "Por favor, ingrese un país válido.";
    }
}

plantilla::aplicar();

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Información de Universidades</h4>
                </div>
                <div class="card-body">
                    <form action="universidad.php" method="post">
                        <div class="form-group mb-3">
                            <label for="pais" class="fw-bold">Buscar universidad por Pais:</label>
                            <input type="text" class="form-control" id="pais" name="pais" <?php echo 'value="' . htmlspecialchars($pais) . '"'; ?> required placeholder="Escribe el nombre del pais...">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i> Buscar Información
                            </button>
                        </div>

                        <?php if(!empty($universidad)): ?>
                            <h5 class="mt-4">Resultados:</h5>
                            <ul class="list-group">
                                <?php foreach($universidad as $uni): ?>
                                    <li class="list-group-item">
                                        <strong><?php echo htmlspecialchars($uni['name']); ?></strong><br>
                                        <?php echo htmlspecialchars($uni['country']); ?><br>
                                        <a href="<?php echo htmlspecialchars($uni['web_pages'][0]); ?>" target="_blank">Visitar Sitio Web</a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php elseif($error !== ''): ?>
                            <div class="alert alert-danger mt-4"><?php echo $error; ?></div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
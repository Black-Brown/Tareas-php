<?php
if (!file_exists(__DIR__ . '/../../config/db_config.php')) {
    header('Location: /../../install.php');
    exit();
} else {
    require_once(__DIR__ . '/../../config/db_config.php');
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        header('Location: /../../install.php');
        exit();
    }
}


define('tabs', 'Personajes');
require('../../libs/index.php');
require_once(__DIR__ . '/../../Models/personaje.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $personajeModel = new Personaje();
    if($personajeModel->eliminarPersonaje($id)) {
        header("Location: Index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar el personaje.</div>";
    }
}

Plantilla::aplicar();
?>

<div class="container mt-5">
    <h2>¿Está seguro que desea eliminar este personaje?</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">
        <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-trash"></i> Sí, eliminar
        </button>
        <a href="Index.php" class="btn btn-secondary">
            <i class="fa-solid fa-xmark"></i> Cancelar
        </a>
    </form>
</div>

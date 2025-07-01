<?php
require('libs/index.php');

Plantilla::aplicar();

$configFile = __DIR__ . '/config/db_config.php';
$showForm = false;
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $dbname = $_POST['dbname'];

    try {
        $conn = new mysqli($host, $user, $pass);
        // Intentar seleccionar la base de datos
        try {
            $conn->select_db($dbname);
        } catch (mysqli_sql_exception $e) {
            // Si falla, crear la base de datos
            $conn->query("CREATE DATABASE `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        }
        // Ahora conectar a la base de datos recién creada
        $conn->close();
        $conn = new mysqli($host, $user, $pass, $dbname);
        if ($conn->connect_error) {
            $error = "No se pudo conectar a la base de datos recién creada: " . $conn->connect_error;
            $showForm = true;
        } else {
            // Crear la tabla personajes si no existe
            $sql = "CREATE TABLE IF NOT EXISTS personajes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                tipo VARCHAR(50) NOT NULL,
                color VARCHAR(50) NOT NULL,
                nivel INT NOT NULL,
                foto VARCHAR(255) NOT NULL
            )";
            if ($conn->query($sql)) {
                // Guardar la configuración en db_config.php
                $configContent = "<?php
define('DB_HOST', '$host');
define('DB_USER', '$user');
define('DB_PASS', '$pass');
define('DB_NAME', '$dbname');
";
                file_put_contents($configFile, $configContent);
                
                // Redireccionar automáticamente después de la instalación exitosa
                if (file_exists(__DIR__ . '/index.php')) {
                    header('Location: index.php');
                } else {
                    echo "ERROR: index.php no existe en la ruta actual: " . __DIR__;
                }
                exit();
            } else {
                $error = "No se pudo crear la tabla: " . $conn->error;
                $showForm = true;
            }
            $conn->close();
        }
    } catch (mysqli_sql_exception $e) {
        $error = "Error de conexión o creación de base de datos: " . $e->getMessage();
        $showForm = true;
    }
} else {
    // Si no existe el archivo de configuración, mostrar el formulario
    if (!file_exists($configFile)) {
        $showForm = true;
    } else {
        require_once($configFile);
        try {
            // Cambiar el nivel de reporte para evitar excepciones por warnings menores
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
            // Verificar que las constantes estén definidas
            if (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PASS') || !defined('DB_NAME')) {
                throw new Exception("Configuración incompleta");
            }
            
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $result = $conn->query("SHOW TABLES LIKE 'personajes'");
            if (!$result || $result->num_rows == 0) {
                $error = "La tabla 'personajes' no existe. Por favor, completa la instalación.";
                $showForm = true;
            } else {
                $showForm = false;
            }
            $conn->close();
        } catch (Exception $e) {
            $error = "No se pudo conectar a la base de datos: " . $e->getMessage();
            $showForm = true;
        }
    }
}
?>

<div class="container mt-5">
    <h2>Asistente de Configuración de Base de Datos</h2>
    <?php if ($showForm): ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label>Servidor</label>
                <input type="text" name="host" class="form-control" value="localhost" required>
            </div>
            <div class="mb-3">
                <label>Usuario</label>
                <input type="text" name="user" class="form-control" value="root" required>
            </div>
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="mb-3">
                <label>Nombre de la base de datos</label>
                <input type="text" name="dbname" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar y crear</button>
        </form>
    <?php else: ?>
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle me-2"></i>
            ¡Configuración completada exitosamente!
            <br><br>
            <strong>La aplicación ya está configurada y lista para usar.</strong>
            <br><br>
            <a href="index.php" class="btn btn-primary mt-2">
                <i class="fa-solid fa-house-chimney me-1"></i> Ir al inicio
            </a>
        </div>
    <?php endif; ?>
</div>
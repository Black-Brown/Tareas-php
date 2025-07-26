<?php
require_once __DIR__ . "/../../models/authModel.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = $_POST["password"];
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);

    if ($usuario && $password && $nombre && $email) {
        $authModel = new authModel();
        $registrado = $authModel->registrar($usuario, $password, $nombre, $email);

        if ($registrado) {
            $mensaje = "<div style='color:green;'>¡Usuario registrado correctamente!</div>";
        } else {
            $mensaje = "<div style='color:red;'>El usuario ya existe.</div>";
        }
    } else {
        $mensaje = "<div style='color:red;'>Completa todos los campos.</div>";
    }
}
?>

<form action="register.php" method="post">
    <?= $mensaje ?>
    <div>
        <label for="usuario">Usuario: </label>
        <input type="text" id="usuario" name="usuario" required>
    </div>

    <div>
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" required>
    </div>

    <div>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required>
    </div>

    <div>
        <button type="submit">Registrar</button>
        <a href='login.php'>Iniciar sesión</a>
    </div>
</form>
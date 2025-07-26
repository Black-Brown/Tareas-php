<?php
session_start();
require_once __DIR__ . "/../../models/authModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $authModel = new authModel();
    $user = $authModel->login($usuario, $password);

    if ($user) {
        // Iniciar sesión
        $_SESSION["user"] = $user;
        header("Location: /Tareas-php/Tarea6/index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>


<form action="login.php" method="post">
    <div>
        <label for="usuario">Usuario: </label>
        <input type="text" id="usuario" name="usuario" required>
    </div>

    <div>
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <button type="submit">Ingresar</button>
        <a href="register.php">Registrarse</a>
    </div>
</form>
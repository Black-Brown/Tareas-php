<?php
$nombre = "";
$apellido = "";
$edad = "";
$carrera = "";
$universidad = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $carrera = $_POST['carrera'];
    $universidad = $_POST['universidad'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjeta Personal</title>
</head>
<body>
    <form method="POST" action="index.php?page=mi_tarjeta">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>
        <br>
        <label for="edad">Edad:</label>
        <input type="number" name="edad" required>
        <br>
        <label for="carrera">Carrera:</label>
        <input type="text" name="carrera" required>
        <br>
        <label for="universidad">Universidad:</label>
        <input type="text" name="universidad" required>
        <br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpiar">

        <?php          
            echo "<h2>Mi Tarjeta Personal</h2>";
            echo "<p><strong>Nombre:</strong> $nombre</p>";
            echo "<p><strong>Apellido:</strong> $apellido</p>";
            if ($edad < 18) {
                echo "<p><strong>Edad:</strong> Menor de edad</p>";
            } else {
                echo "<p><strong>Edad:</strong> Mayor de edad</p>";
            }
            echo "<p><strong>Carrera:</strong> $carrera</p>";
            echo "<p><strong>Universidad:</strong> $universidad</p>";
        ?>
    </form>
</body>
</html>


<?php
$numero1 = "";
$numero2 = "";
$operacion = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacion = $_POST['operacion'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form action="index.php?page=calculadora" method="post">
        <label for="numero1">Número 1:</label>
        <input type="number" name="numero1" required>
        <br>
        <label for="numero2">Número 2:</label>
        <input type="number" name="numero2" required>
        <br>
        <label for="operacion">Operación:</label>
        <select name="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    switch ($operacion) {
        case 'suma':
            $resultado = $numero1 + $numero2;
            break;
        case 'resta':
            $resultado = $numero1 - $numero2;
            break;
        case 'multiplicacion':
            $resultado = $numero1 * $numero2;
            break;
        case 'division':
            if ($numero2 != 0) {
                $resultado = $numero1 / $numero2;
            } else {
                echo "<p>No se puede dividir entre cero.</p>";
                exit();
            }
            break;
        default:
            echo "<p>Operación no válida.</p>";
            exit();
        }
    echo "<h2>la $operacion de $numero1 y $numero2 es: $resultado</h2>";

    ?>
</body>
</html>



<?php
$numero_input = "";
$numero_secreto = rand(1, 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el numero</title>
</head>
<body>
    <form action="index.php?page=adivina" method="post">
        <label for="numero_input">Adivina el numero del 1 al 5:</label>
        <input type="number" name="numero_input" required>
        <br>
        <input type="submit" value="Enviar">
        <br>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_input = $_POST['numero_input'];
            if ($numero_input == $numero_secreto) {
                echo "<p>Felicidades, Adivinaste el numero secreto: $numero_secreto</p>";
            } else {
                echo "<p>Lo siento, el numero secreto era: $numero_secreto</p>";
            }
        }
        ?>
    </form>
</body>
</html>
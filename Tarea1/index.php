<!-- index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Primera Tarea</title>
</head>
<body>
    <div class="main-container">
        <section>
            <div>
                <h1>Mi Lista</h1>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php?page=mi_tarjeta">Mi tarjeta</a></li>
                    <li><a href="index.php?page=calculadora">Calculadora</a></li>
                    <li><a href="index.php?page=adivina">Adivinanza</a></li>
                    <li><a href="index.php?page=acerca_de">Acerca de</a></li>
                </ul>
            </div>
        </section>

        <hr>

        <section>
            <?php
            if (isset($_GET['page'])) {
                $pagina = $_GET['page'] . ".php";


                if (file_exists($pagina)) {
                    include($pagina);
                } else {
                    echo "<p> Página no encontrada.</p>";
                }
            } else {
                echo "<p>Elige una opción del menú para comenzar.</p>";
            }
            ?>
        </section>
    </div>

    <footer>
        <p>Desarrollado por Jheinel Brown - 2024-0017</p>
        <p>&copy; 2025 Tarea 1</p>
    </footer>
</body>
</html>

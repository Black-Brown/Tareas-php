<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tarea2</title>
</head>
<body>
    <div> 
        <section>
            <div>
                <h1>Mi Lista</h1>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php?page=agregar_personaje">Agregar Personaje</a></li>
                    <li><a href="index.php?page=detalle">Detalles</a></li>
                    <li><a href="index.php?page=Registrar_obra">Registrar obras</a></li>
                    <li><a href="index.php?page=ver_obras">Ver Obras</a></li>
                </ul>

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
            </div>
        </section>
    </div>
    
</body>
</html>
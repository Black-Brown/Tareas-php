<?php

class plantilla {

    // se crea una instancia donde se va a crear la plantilla
    private static $instancia = null;

    public static function aplicar(){
        if(self::$instancia === null){
            self::$instancia =  new plantilla();
        }
    }

    public function __construct(){
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Segundo parcial</title>
</head>

<body class="container">
    <h1 class="text-center">Bienvenido al segundo parcial</h1>
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'inicio') ? 'active': '';?>"
                href="\index.php">Incio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'listar') ? 'active': '';?>"
                href="\views\visitas\listar.php">Visitas</a>
        </li>
    </ul>

    <?php
    }

    public function __destruct(){
        ?>
    <hr>
    <footer class="text-center">
        <p>&copy; Jheinel Brown - matricula 2024-0017</p>
        <p>todos los derechos estan reservados</p>
    </footer>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
    }
}
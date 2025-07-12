<?php

class plantilla {
    public static $instancia = null;

    public static function aplicar(){
        if(self::$instancia === null){
            self::$instancia = new plantilla();
        }
    }


    public function __construct(){
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>segundo parcial</title>
</head>

<body class="container">

    <div class="text-center">
        <h1>Bienvenido al Segundo parcial</h1>
    </div>

    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'inicio') ? 'active': ''; ?>"  href="\index.php">Incio</a>
        </li>
        <li class="nav-link">
            <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'listas') ? 'active': ''; ?>" href="\views\visitas\listar.php">Visitas</a>
        </li>
    </ul>

    <?php
    }

    public function __destruct(){
        ?>
    <hr>
    <footer class="text-center">
        <p>&copy; Jheinel Brown</p>
        <p>todos los derechos son reservados</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
    }
}
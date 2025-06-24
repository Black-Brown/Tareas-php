<?php


class plantilla {

    public static $instancia = null;

    public static function aplicar(){
        if(self::$instancia === null){
            self::$instancia = new plantilla();
        }
        return self::$instancia;
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
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Tarea 4</title>
</head>
<body>
    <div class="container mt-3">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Inicio') ? 'active' : ''; ?>" href="../index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Genero') ? 'active' : ''; ?>" href="/modulos/prediccion_genero.php"><i class="fa fa-venus-mars"></i></a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Edad') ? 'active' : ''; ?>" href="/modulos/prediccion_edad.php"><i class="fa fa-birthday-cake"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Universidad') ? 'active' : ''; ?>" href="/modulos/universidad.php"><i class="fa fa-university"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Clima') ? 'active' : ''; ?>" href="/modulos/prediccion_clima.php"><i class="fa fa-cloud-sun"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Pokemon') ? 'active' : ''; ?>" href="/modulos/pokemon.php"><i class="fa fa-bolt"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo (defined('tabs') && constant('tabs') === 'Noticias') ? 'active' : ''; ?>" href="/modulos/noticias_wordpress.php"><i class="fa fa-newspaper"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo (defined('tabs') && constant('tabs') === 'Moneda') ? 'active' : ''; ?>" href="/modulos/conversion_moneda.php"><i class="fa fa-coins"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo (defined('tabs') && constant('tabs') === 'Imagenes') ? 'active' : ''; ?>" href="/modulos/generador_img.php"><i class="fa fa-image"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo (defined('tabs') && constant('tabs') === 'Pais') ? 'active' : ''; ?>" href="/modulos/datos_pais.php"><i class="fa fa-globe"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Risa') ? 'active' : ''; ?>" href="/modulos/generador_chiste.php"><i class="fa fa-face-laugh"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Acerca de') ? 'active' : ''; ?>" href="/modulos/acerca_de.php">Acerca de</a>
            </li>
        </ul>
    </div>        
        <?php

    }

    public function __destruct(){
        ?>

<div class="container">
    <footer class="text-center mt-5">
    <hr>
    <p>&copy; Jheinel Brown matricula 2024-0017</p>
    <p> Que todos los derechos esta reservados son mios EH XD</p>
</footer>
</div>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

        <?php

    }



}
<?php

class Plantilla 
{
    public static $instancia = null;

    public static function aplicar() {
        if(self::$instancia === null){
            self::$instancia = new Plantilla();
        }
    }

    public function __construct() {
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/../Libs/utils/styles.css">
    <title>Tarea 5</title>
</head>
<body>
    <div class="container">
        <ul class="nav nav-tabs nav-justified" style="font-size: 1.2rem;">
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Inicio') ? 'active' : ''; ?>" href="/../index.php">
                    <i class="fa-solid fa-house-chimney"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Personajes') ? 'active' : ''; ?>" href="/Views/personajes/Index.php">
                    <i class="fa-solid fa-user-ninja"></i> Personajes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (defined('tabs') && constant('tabs') === 'Acerca de') ? 'active' : ''; ?>" href="/Views/acerca_de/index.php">
                    <i class="fa-solid fa-circle-info"></i> Acerca de
                </a>
            </li>
        </ul>
    </div>
<div class="main-content">
        <?php
        
    }

    public function __destruct() {
        ?>
        </div>
        <div class="container mt-5">
            <footer class="text-center">
                <hr>
                <p>
                    <i class="fa-solid fa-heart text-danger"></i>
                    <span style="font-family: 'Comic Sans MS', cursive, sans-serif; font-size: 1.1rem;">
                        &copy; Jheinel Brown | Matricula 2024-0017
                    </span>
                    <i class="fa-solid fa-heart text-danger"></i>
                </p>
                <p>
                    <i class="fa-solid fa-star text-warning"></i>
                    <span style="font-family: 'Comic Sans MS', cursive, sans-serif;">
                        ¡Todos los derechos reservados! Anime Power!
                    </span>
                    <i class="fa-solid fa-star text-warning"></i>
                </p>
                <p>
                    <i class="fa-solid fa-mug-hot"></i>
                    <span style="font-family: 'Comic Sans MS', cursive, sans-serif;">
                        Powered by <b>Otaku Energy</b> <i class="fa-solid fa-bolt"></i>
                    </span>
                </p>
                <p>
                    <i class="fa-solid fa-book text-primary"></i>
                    <span style="font-family: 'Comic Sans MS', cursive, sans-serif;">
                        <a href="/install.php" class="text-decoration-none text-primary">
                            Guía de Instalación de la BD
                        </a>
                    </span>
                    <i class="fa-solid fa-book text-primary"></i>
                </p>
            </footer>
        </div>
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

        <?php
    }
}
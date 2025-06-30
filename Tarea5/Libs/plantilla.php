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
    <title>Tarea 5</title>
    <style>
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>
<div class="main-content">
    <h1>Bienvenido a la Tarea 5</h1>

        <?php
        
    }

    public function __destruct() {
        ?>
        </div>
        <div class="container mt-5">
            <footer class="text-center">
                <hr>
                <p>&copy; Jheinel Brown matricula 2024-0017</p>
                <p>Que todos los derechos esta reservados son mios EH XD</p>
            </footer>
        </div>
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

        <?php
    }
}
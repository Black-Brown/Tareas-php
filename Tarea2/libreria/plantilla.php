<?php

class Plantilla {

    public static $instancia = null;

    public static function aplicar(){
        if (self::$instancia === null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }

    public function __construct() {

        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Agrega Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Home</title>
</head>
<body class="container">  
    <h1 class="text-center mt-5">
        <a href="index.php" class="mt-4" >
            <i class="fa-solid fa-house" style="color:rgb(0, 145, 255);" height="50px"></i>
            Welcome to homework 2
        </a>
    </h1>


<?php
        
    }

    public function __destruct() {

        ?>
        
    <footer class="container text-center mt-5">
        <hr>
        <p>&copy; 2025 Jheinel Brown 2024-0017</p>
        <p>Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
        
    }
}
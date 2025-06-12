<?php
// made by Jheinel Brown Matricula 2024-0017

class plantilla {

    public static $instancia = null;

    public static function aplicar(){
        if(self::$instancia === null){
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }

    // funcion para mostrar la primera parte de la plantilla
    public function __construct(){
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Primer Parcial</title>
</head>
<body class="text-center">
<h1>Consultorio Dental</h1>
<hr>

        <?php

    }

    // funcion para mostrar la segunda parte de la plantilla
    public function __destruct(){
        ?>
 <hr>       
<footer>
    <p>&copy; Jheinel Brown matricula 2024-0017</p>
    <p> Que todos los derechos esta reservados son mios EH XD</p>
</footer>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
        <?php

    }


}
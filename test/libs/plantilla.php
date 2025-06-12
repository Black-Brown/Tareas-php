<?php

class plantilla {

    public static $instancia = null;

    public static function aplicar(){
        if (self::$instancia === null) {
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
    <title>Primer Parcial</title>
</head>
<body>

<h1>✨Bienvenido al primer parcial</h1>


        <?php

    }

    public function __destruct(){
        ?>
        <div">
        <hr>
        <footer>
    <p>&copy; Jheinel Brown matricula 2024-0017 </p>
    <p>Todos lo derechos son mio eh</p>
    </div>
    
</footer>
</body>
</html>

        <?php
    }
}
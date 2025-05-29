<?php

class Plantilla {

    public static $instancia = null;

    public static function aplicar(){
        if (self::$instancia === null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }

    public function __constructor() {

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Tarea2</title>
        </head>
        <body>
            <h1>Mi lista</h1>
            <div> 
                <section>
                    <div>

<?php
        
    }

    public function __destruct() {

        ?>
         <div>
        <hr>
        <footer>
            <p>&copy; 2025 Tarea2</p>
    </div>
</body>
</html>

<?php
        
    }
}
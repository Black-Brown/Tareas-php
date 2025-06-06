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

        $pagina_actual = (defined('PAGINA_ACTUAL') ? PAGINA_ACTUAL : 'inicio');

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
<body> 
    <div class="container">
        <div>
            <h1>Mundo de barbie</h1>
        </div>
        <div class="divMenu">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link <?php echo (defined('PAGINA_ACTUAL') && PAGINA_ACTUAL == 'inicio') ? 'active' : ''; ?>" href="<?=base_url(''); ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (defined('PAGINA_ACTUAL') && PAGINA_ACTUAL == 'personaje') ? 'active' : ''; ?>" href="<?=base_url('modulos/personajes/lista.php'); ?>">Personajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (defined('PAGINA_ACTUAL') && PAGINA_ACTUAL == 'profesion') ? 'active' : ''; ?>" href="<?=base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('modulos/reportes/menu.php'); ?>" class="nav-link <?php echo (defined('PAGINA_ACTUAL') && PAGINA_ACTUAL == 'estadistica') ? 'active' : ''; ?>">Estadistica</a>
                </li>
            </ul>
        </div>
    </div>
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
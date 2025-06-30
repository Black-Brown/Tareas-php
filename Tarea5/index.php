<?php
require('libs/plantilla.php');
require('config/db_config.php');
require('Models/personaje.php');

Plantilla::aplicar();

$personajeModel = new Personaje();
$personajes = $personajeModel->obtenerPersonajes();

foreach ($personajes as $personaje) {
    echo "ID: " . $personaje['id'] . "<br>";
    echo "Nombre: " . $personaje['nombre'] . "<br>";
    echo "Nivel: " . $personaje['nivel'] . "<br>";
    echo "<hr>";
}

?>



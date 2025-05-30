<?php

require('libreria/plantilla.php');
require_once('libreria/objecto.php'); // Asegúrate que aquí está la clase obra


$codigo = $_GET['codigo'];
$cedula = $_GET['cedula'];

$ruta = 'datos/' . $codigo . '.json';
if (!file_exists($ruta)) {
    plantilla::aplicar();

    echo "<div class='alert alert-danger'> Error al eliminar el personaje.</div>";
    echo "<a href='personaje.php?codigo=" . urlencode($codigo) . "' class='btn btn-primary'>Volver a la obra</a>";
    exit();
    
} 

$json = file_get_contents($ruta);
$obra = json_decode($json);

$personaje = null;
foreach ($obra->personajes as $key => $p) {
    if ($p->cedula === $cedula) {
        $personaje = $p;
        unset($obra->personajes[$key]);
        break;
    }
}

if ($personaje === null) {
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>Personaje no encontrado.</div>";
    echo "<a href='personaje.php?codigo=" . urlencode($codigo) . "' class='btn btn-primary'>Volver a la obra</a>";
    exit();
}


$obra->personajes = array_values(array_filter($obra->personajes, function($p) use ($cedula){
    return $p->cedula !== $cedula;
}));

file_put_contents($ruta, json_encode($obra));
plantilla::aplicar();

echo "<div class='alert alert-success'>Personaje eliminado exitosamente!</div>";
echo "<a href='personaje.php?codigo=" . urlencode($codigo) . "' class='btn btn-primary'>Volver a la obra</a>";
exit();

<?php

require('plantilla.php');
require_once(__DIR__ . '/objeto.php');
include_once(__DIR__ . '/Dbx.php');

function base_url($path = "") {
    // Determinar el protocolo (HTTP o HTTPS)
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    
    // Obtener el host del servidor
    $host = $_SERVER['HTTP_HOST'];
    
    // Eliminar barras diagonales al inicio y final de la ruta
    $path = trim($path, "/");
    
    // Construir y retornar la URL completa
    return $protocol . $host . "/" . $path;
}


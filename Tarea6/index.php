<?php
require("config/database.php");
require("models/sistemaModel.php");

$db = new database();
session_start();

?>

<a href="views/sistema/index.php">Ir a Sistema de Ventas</a>
<a href="views/categoria/index.php">Ir a Categorías</a>
<a href="views/productos/index.php">Ir a Productos</a>
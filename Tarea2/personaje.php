<?php

require('libreria/principal.php');

if(isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $ruta = 'datos/' . $codigo . '.json';
    if (file_exists($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    }
} else {
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>erro al cargar la obra.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al inicio</a>";
    exit();
} 

plantilla::aplicar();

?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="row w-100">
        <!-- Detalle de la obra (izquierda) -->
        <div class="col-md-5 mb-4">
            <h2 class="bg-primary text-white text-center p-2">Detalles de <?php echo htmlspecialchars($obra->nombre); ?></h2>
            <table class="table table-bordered">
                <tr>
                    <th colspan="2" class="text-center">
                        <img class="img-fluid rounded mb-3" src="<?php echo htmlspecialchars($obra->foto_url); ?>" alt="Foto" style="max-width: 250px; height: auto;">
                    </th>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td><?php echo htmlspecialchars($obra->tipo); ?></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><?php echo htmlspecialchars($obra->nombre); ?></td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td><?php echo htmlspecialchars($obra->descripcion); ?></td>
                </tr>
                <tr>
                    <th>País</th>
                    <td><?php echo htmlspecialchars($obra->pais); ?></td>
                </tr>
                <tr>
                    <th>Autor</th>
                    <td><?php echo htmlspecialchars($obra->autor); ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <a href="editar.php?codigo=<?php echo urlencode($obra->codigo); ?>" class="btn btn-warning">Editar</a>
                        <a href="personaje.php?codigo=<?php echo urlencode($obra->codigo); ?>" class="btn btn-success">Personajes</a>
                        <a href="index.php" class="btn btn-primary">Volver al inicio</a>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Personajes (derecha) -->
        <div class="col-md-7">
            <h2 class="bg-secondary text-white text-center p-2">Personajes de <?php echo htmlspecialchars($obra->nombre); ?></h2>
            <div class="mb-3 text-end">
                <a href="agregar_personaje.php?codigo=<?php echo $obra->codigo; ?>" class="btn btn-primary">Agregar Personaje</a>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Habilidad</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $personajes = $obra->personajes ?? [];
                    foreach ($personajes as $personaje) {
                        echo "<tr>";
                        echo "<td><img src='" . htmlspecialchars($personaje->foto_url) . "' alt='Foto' style='width: 100px;'></td>";
                        echo "<td>" . htmlspecialchars($personaje->nombre) . "</td>";
                        echo "<td>" . htmlspecialchars(is_array($personaje->habilidades) ? implode(', ', $personaje->habilidades) : $personaje->habilidades) . "</td>";
                        echo "<td>
                                <a href='eliminar_personaje.php?codigo=" . urlencode($obra->codigo) . "&cedula=" . urlencode($personaje->cedula) . "' class='btn btn-danger'>Eliminar</a>
                             </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
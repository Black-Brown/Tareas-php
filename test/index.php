<?php

require ('libs\index.php');
plantilla::aplicar();

?>

<a href="registrar.php">agregar</a>
<table>
    <thead>
        <tr>
            <td>Nombre</td>
            <td>Motivo</td>
            <td>Fecha de visita</td>
        </tr>
    </thead>
    <tbody>
        <?php
            if(is_dir('data')){
            $buscar = scandir('data');
                foreach($buscar as $file){
                    $path = 'data/' . $file;

                    if(is_file($path)) {

                        $json = file_get_contents($path);
                        $paciente = json_decode($json);

                        echo "<tr>";
                        echo "<td> {$paciente->nombre}</td>";
                        echo "<td> {$paciente->motivo}</td>";
                        echo "<td> {$paciente->fecha_hora}</td>";
                        echo "</tr>";
                    }
                }
            }
        ?>
    </tbody>
</table>
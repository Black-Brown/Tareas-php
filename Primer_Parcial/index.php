<?php
// made by Jheinel Brown Matricula 2024-0017

require('libs/index.php');
plantilla::aplicar();

?>

<!-- muestra la tabla para presentar los datos ingresados -->
<div class="container">
    <div>
        <a href="agregar.php" class="btn btn-primary"> Registrar visita del paciente </a>
    </div>
    <div style="margin-top: 10px;">
        <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Motivo de visita</td>
                    <th>Fecha de la visita</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(is_dir('data')){
                    // escanea lo que contiene el directoio 'data'
                    $buscar = scandir('data');

                    // lista lo que se encuentra en dicho directorio
                    foreach($buscar as $file){
                        $ruta = 'data/' .  $file;
                        if(is_file($ruta)){
                            $json = file_get_contents($ruta);
                            $paciente = json_decode($json);

                            echo "<tr>";
                            echo "<td>{$paciente->nombre}</td>";
                            echo "<td>{$paciente->apellido}</td>";
                            echo "<td>{$paciente->edad}</td>";
                            echo "<td>{$paciente->motivo}</td>";
                            echo "<td>{$paciente->fecha_hora}</td>";
                            echo "<tr>";

                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    
</div>
<?php
require('libreria/principal.php');
plantilla::aplicar();
 ?>

    <section class="container text-center mt-5">
        <p>Aplicacion web para agregar peliculas y personajes.</p>
        <a href="agregar.php" class="btn btn-primary btn-lg">agregar</a>
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <td>Foto</td>
                    <td>tipo</td>
                    <td>nombre</td>
                    <td>país</td>
                    <td>Personajes</td>
                    <td>Accion</td>  
                </tr>
            </thead>
            <tbody>
                <?php
                     
                     if(is_dir(filename: 'datos')) {
                         
                        $archivos = scandir(directory: 'datos');

                        foreach ($archivos as $archivo) {
                            $ruta = 'datos/' . $archivo;
                            if (is_file(filename: $ruta)) {
                                
                                $json = file_get_contents($ruta);
                                $obra = json_decode($json);
                                
                                echo "<tr>";
                                echo "<td><img src='{$obra->foto_url}' alt='Foto' style='width: 100px;'></td>";
                                echo "<td>{$obra->tipo}</td>";
                                echo "<td>{$obra->nombre}</td>";
                                echo "<td>{$obra->pais}</td>";
                                echo "<td>" . (isset($obra->personajes) && is_array($obra->personajes) ? count($obra->personajes) : 0) . "</td>";                               
                                echo "<td>
                                        <a href='editar.php?codigo={$obra->codigo}' class='btn btn-warning'>Editar</a>
                                        <a href='personaje.php?codigo={$obra->codigo}' class='btn btn-success'>Personaje</a>
                                        <a href='detalle.php?codigo={$obra->codigo}' class='btn btn-info'>Detalles</a>
                                      </td>";
                                echo "</tr>";
                            }
                        }
                     }
                ?>
            </tbody>
        </table>
    </section>
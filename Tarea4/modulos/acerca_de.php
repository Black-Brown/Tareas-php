<?php
define('tabs', 'Acerca de');
require("../libs/index.php");

plantilla::aplicar();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="fa fa-info-circle"></i> Acerca de</h2>
                </div>
                <div class="card-body">
                    <p class="lead">
                        Esta aplicación es un proyecto de ejemplo que utiliza diversas APIs para ofrecer funcionalidades interesantes.
                    </p>
                    <hr>
                    <h5 class="mb-2"><i class="fa-brands fa-bootstrap"></i> Framework CSS utilizado</h5>
                    <p>
                        <strong>Bootstrap 5</strong> fue elegido como framework CSS para este proyecto.<br>
                        <span><strong>¿Por qué Bootstrap?</strong></span>
                        <ul>
                            <li>Permite crear interfaces modernas y responsivas de forma rápida.</li>
                            <li>Ofrece una gran variedad de componentes listos para usar.</li>
                            <li>Es ampliamente documentado y fácil de integrar con PHP.</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
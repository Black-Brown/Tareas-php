<?php

include("libreria/principal.php");
define('PAGINA_ACTUAL', 'inicio');

plantilla::aplicar();

?>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <h1 class="display-4" style="color: #e0218a; font-family: 'Comic Sans MS', cursive, sans-serif;">
                ✨Bienvenida al Mundo de Barbie✨
            </h1>
            <p class="lead" style="color: #ff69b4; font-size: 1.5rem;">
                Descubre un universo lleno de sueños, amistad y diversión. <br>
                ¡Aquí todo es posible y la magia nunca termina!
            </p>
        </div>
        <div class="col-12">
            <img src="https://imgv3.fotor.com/images/blog-cover-image/barbie-movie-quotes-cover.png"
                 alt="Barbie"
                 class="img-fluid mx-auto d-block mt-4 rounded shadow-lg"
                 style="max-width: 600px; border: 5px solid #e0218a;">
        </div>
    </div>
</section>
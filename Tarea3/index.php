<?php

include("libreria/principal.php");
define('PAGINA_ACTUAL', 'inicio');

plantilla::aplicar();

?>

<!-- Barbie Style -->
<style>
    body {
        background: linear-gradient(135deg, #ffb6e6 0%, #ffe3f6 100%);
        min-height: 100vh;
    }
    .barbie-card {
        background: linear-gradient(135deg, #fff0fa 0%, #ffe3f6 100%);
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px 0 rgba(255, 105, 180, 0.15);
        color: #d7268a;
        transition: transform 0.2s;
    }
    .barbie-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 32px 0 rgba(255, 105, 180, 0.25);
    }
    .barbie-title {
        font-family: 'Comic Sans MS', 'Comic Sans', cursive;
        color: #ff69b4;
        text-shadow: 1px 1px 0 #fff, 2px 2px 0 #ffb6e6;
        font-size: 2.5rem;
        letter-spacing: 2px;
    }
    .barbie-section-title {
        color: #d7268a;
        font-weight: bold;
        margin-top: 2rem;
        margin-bottom: 1rem;
        text-shadow: 1px 1px 0 #fff;
    }
    .barbie-list li {
        color: #d7268a;
        font-weight: 500;
    }
    .barbie-chart {
        background: #fff0fa;
        border-radius: 1rem;
        padding: 1rem;
        box-shadow: 0 2px 12px 0 rgba(255, 105, 180, 0.10);
    }
    .display-6 {
        color: #ff69b4;
        font-weight: bold;
        font-size: 2.2rem;
    }
    .barbie-badge {
        background: linear-gradient(90deg, #ff69b4 0%, #ffb6e6 100%);
        color: #fff;
        font-size: 1rem;
        border-radius: 1rem;
        padding: 0.3em 1em;
        margin-left: 0.5em;
    }
</style>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <h1 class="display-4 barbie-title">
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
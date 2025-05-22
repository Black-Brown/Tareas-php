<?php
$nombre = "Jheinel";
$apellido = "Brown";
$foto = "img\IMG_20250330_131205_179.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
</head>
<body>
    <h1>Acerca de mí</h1>
        <section class="profile-card">
            <img class="profile-img" src="<?php echo $foto; ?>" alt="Foto de <?php echo $nombre . ' ' . $apellido; ?>">
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Apellido:</strong> <?php echo $apellido; ?></p>
        </section>
    <h1>Redes Sociales</h1>
        <section class="social-media">
            <a class="social-icons" href="https://wa.me/18292140724" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
            </a>
            <a class="social-icons" href="https://https://t.me/Jheinel Brown" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram">
            </a>
        </section>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/EKBflkO9e-E" 
        title="Los 5 Mejores Negocios Con Inteligencia Artificial (Probados)" frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
    </iframe>
</body>
</html>
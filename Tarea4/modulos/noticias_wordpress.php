<?php
define('tabs', 'Noticias');
require("../libs/index.php");

$url_base = 'https://wordpress.com/es/blog/category/noticias/';
$noticias = [];
$error = '';
$logo = 'https://s.w.org/style/images/about/WordPress-logotype-wmark.png';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url_base = rtrim($_POST['pagina'], '/');
}

$html = @file_get_contents($url_base);

if ($html !== false) {
    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    if ($dom->loadHTML($html)) {
        $xpath = new DOMXPath($dom);
        // Busca los artículos en la página (ajusta el selector según la estructura actual)
        $articles = $xpath->query("//article");
        foreach ($articles as $article) {
            $titleNode = $xpath->query(".//h2//a", $article)->item(0);
            $excerptNode = $xpath->query(".//p", $article)->item(0);
            $dateNode = $xpath->query(".//time", $article)->item(0);

            if ($titleNode) {
                $noticias[] = [
                    'title' => $titleNode->nodeValue,
                    'link' => $titleNode->getAttribute('href'),
                    'excerpt' => $excerptNode ? $excerptNode->nodeValue : '',
                    'date' => $dateNode ? $dateNode->getAttribute('datetime') : '',
                ];
            }
            if (count($noticias) >= 3) break; // Solo las 3 primeras
        }
    } else {
        $error = "No se pudo analizar el HTML de la página.";
    }
    libxml_clear_errors();
} else {
    $error = "Error al conectar con la página de noticias.";
}

plantilla::aplicar();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <img src="<?= $logo ?>" alt="Logo" style="height:40px; margin-right:15px;">
                    <h4 class="mb-0">Noticias de WordPress</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="mb-4">
                        <label for="pagina" class="form-label fw-bold">Página WordPress:</label>
                        <input type="text" class="form-control" id="pagina" name="pagina" required value="<?= htmlspecialchars($url_base) ?>">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary mt-2">
                                <i class="fa fa-search"></i> Buscar Noticias
                            </button>
                        </div>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($noticias): ?>
                        <?php foreach ($noticias as $noticia): ?>
                            <div class="mb-4 border-bottom pb-3">
                                <h5>
                                    <a href="<?= htmlspecialchars($noticia['link']) ?>" target="_blank" class="text-decoration-none text-primary">
                                        <?= htmlspecialchars($noticia['title']) ?>
                                    </a>
                                </h5>
                                <div class="text-muted small mb-2">
                                    <?= $noticia['date'] ? date('d/m/Y', strtotime($noticia['date'])) : '' ?>
                                </div>
                                <div>
                                    <?= htmlspecialchars($noticia['excerpt']) ?>
                                </div>
                                <a href="<?= htmlspecialchars($noticia['link']) ?>" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                                    Leer más
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">No hay noticias para mostrar.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
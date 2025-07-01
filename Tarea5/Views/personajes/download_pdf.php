<?php
require_once('../../Libs/TCPDF-6.10.0/tcpdf.php');
require_once(__DIR__ . '/../../Models/personaje.php');
require_once(__DIR__ . '/../../config/db_config.php');

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die('Error: ID de personaje no válido.');
}

try {
    $personajeModel = new Personaje();
    $personaje = $personajeModel->obtenerPersonajePorId($id);

    if (!$personaje) {
        die('Error: Personaje no encontrado.');
    }

    // Función para descargar imagen usando cURL (más robusta)
    function descargarImagenCurl($url) {
        if (!function_exists('curl_init')) {
            // Fallback a file_get_contents si cURL no está disponible
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'timeout' => 10
                ]
            ]);
            return @file_get_contents($url, false, $context);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200 && $data !== false) {
            return $data;
        }
        
        return false;
    }

    // Crear PDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('Naruto App');
    $pdf->SetAuthor('Naruto App');
    $pdf->SetTitle('Ficha Ninja - ' . $personaje['nombre']);
    $pdf->SetMargins(20, 20, 20);
    $pdf->SetAutoPageBreak(TRUE, 20);
    $pdf->AddPage();

    // Fondo naranja Naruto
    $pdf->SetFillColor(255, 153, 51);
    $pdf->Rect(0, 0, 210, 297, 'F');

    // Logo de Konoha (local)
    try {
        $logoPath = __DIR__ . '/../../Libs/img/pngwing.com.png';
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 10, 10, 30, 30, '', '', '', false, 300);
        }
    } catch (Exception $e) {
        error_log('Error cargando logo: ' . $e->getMessage());
    }

    // Título
    $pdf->SetFont('helvetica', 'B', 28);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 30, 'Ficha Ninja', 0, 1, 'C');
    $pdf->Ln(10);

    // Foto del personaje
    if (!empty($personaje['foto'])) {
        $foto = $personaje['foto'];
        $imagenCargada = false;
        
        try {
            if (filter_var($foto, FILTER_VALIDATE_URL)) {
                $imageData = descargarImagenCurl($foto);
                
                if ($imageData !== false) {
                    $pdf->Image('@' . $imageData, 80, 50, 50, 50, '', '', '', false, 300);
                    $imagenCargada = true;
                }
            } else {
                $rutaLocal = __DIR__ . '/../../' . ltrim($foto, '/');
                if (file_exists($rutaLocal)) {
                    $pdf->Image($rutaLocal, 80, 50, 50, 50, '', '', '', false, 300);
                    $imagenCargada = true;
                }
            }
        } catch (Exception $e) {
            error_log('Error cargando foto: ' . $e->getMessage());
        }
        
        if (!$imagenCargada) {
            // Placeholder
            $pdf->SetFillColor(200, 200, 200);
            $pdf->Rect(80, 50, 50, 50, 'F');
            $pdf->SetDrawColor(150, 150, 150);
            $pdf->Rect(80, 50, 50, 50, 'D');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->SetXY(80, 72);
            $pdf->Cell(50, 6, 'Imagen no disponible', 0, 0, 'C');
        }
    }
    
    $pdf->Ln(65);

    // Datos del personaje debajo del título
    $pdf->SetY(105); // Justo debajo de la imagen (50 + 50 + 5)
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 10, htmlspecialchars($personaje['nombre']), 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('helvetica', '', 14);
    $pdf->Cell(0, 10, 'Tipo: ' . htmlspecialchars($personaje['tipo']), 0, 1, 'C');
    $pdf->Cell(0, 10, 'Color característico: ' . htmlspecialchars($personaje['color']), 0, 1, 'C');
    $pdf->Cell(0, 10, 'Nivel: ' . htmlspecialchars($personaje['nivel']), 0, 1, 'C');

    $pdf->Ln(20);
    $pdf->SetFont('helvetica', 'I', 12);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(0, 10, 'Universo: Naruto', 0, 1, 'C');

    $nombreArchivo = 'ficha_ninja_' . preg_replace('/[^a-zA-Z0-9_\-]/', '_', strtolower($personaje['nombre'])) . '.pdf';
$pdf->Output($nombreArchivo, 'D');
exit();

} catch (Exception $e) {
    error_log('Error generando PDF: ' . $e->getMessage());
    die('Error: No se pudo generar el PDF.');
}
?>
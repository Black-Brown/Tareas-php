<?php
include('../../libreria/principal.php');
require_once(__DIR__ . '/../../libreria/objeto.php');
define('PAGINA_ACTUAL', 'estadistica');

$personajes = Dbx::listar('personaje') ?: [];
$profesiones = Dbx::listar('profesiones') ?: [];

// Función para calcular edad a partir de fecha de nacimiento
function calcularEdad($fechaNacimiento) {
    if (!$fechaNacimiento || $fechaNacimiento === '0000-00-00') {
        return 0;
    }
    
    $hoy = new DateTime();
    $nacimiento = new DateTime($fechaNacimiento);
    $edad = $hoy->diff($nacimiento);
    return $edad->y;
}

// Cantidad total de personajes y profesiones
$totalPersonajes = is_array($personajes) ? count($personajes) : 0;
$totalProfesiones = is_array($profesiones) ? count($profesiones) : 0;

// Edad promedio de los personajes (entero)
$edades = [];
foreach ($personajes as $p) {
    $fecha_nac = isset($p->fecha_nacimiento) ? $p->fecha_nacimiento : null;
    if ($fecha_nac && $fecha_nac !== '0000-00-00') {
        $edades[] = calcularEdad($fecha_nac);
    }
}
$edadPromedio = count($edades) > 0 ? round(array_sum($edades) / count($edades)) : 0;

// Distribución de personajes según categoría de profesión
$categoriaDistribucion = [];
$profesionesMap = [];
foreach ($profesiones as $prof) {
    $profesionesMap[$prof->idx] = $prof;
}

// Asegurarse de que todas las categorías estén inicializadas
foreach ($profesiones as $prof) {
    if (!isset($categoriaDistribucion[$prof->categoria])) {
        $categoriaDistribucion[$prof->categoria] = 0;
    }
}

// Contar personajes por categoría
foreach ($personajes as $p) {
    $profId = isset($p->profesion) ? $p->profesion : null;
    if ($profId && isset($profesionesMap[$profId])) {
        $cat = $profesionesMap[$profId]->categoria;
        if (!isset($categoriaDistribucion[$cat])) {
            $categoriaDistribucion[$cat] = 0;
        }
        $categoriaDistribucion[$cat]++;
    }
}

// Nivel de experiencia más común
$niveles = [];
foreach ($personajes as $p) {
    $nivel = isset($p->nivel_experiencia) ? $p->nivel_experiencia : null;
    if ($nivel !== null && $nivel !== '') {
        if (!isset($niveles[$nivel])) $niveles[$nivel] = 0;
        $niveles[$nivel]++;
    }
}
$nivelMasComun = !empty($niveles) ? array_search(max($niveles), $niveles) : 'N/A';

// Profesión con salario más alto y más bajo
$salarios = [];
foreach ($profesiones as $prof) {
    $salarios[$prof->idx] = $prof->salario_mensual;
}
$profesionMayorSalario = $profesionMenorSalario = null;
if ($salarios) {
    $maxSalario = max($salarios);
    $minSalario = min($salarios);
    foreach ($profesiones as $prof) {
        if ($prof->salario_mensual == $maxSalario) $profesionMayorSalario = $prof;
        if ($prof->salario_mensual == $minSalario) $profesionMenorSalario = $prof;
    }
}

// Salario promedio en el mundo Barbie
$salarioPromedio = count($salarios) ? round(array_sum($salarios) / count($salarios), 2) : 0;

// Personaje con el salario más alto
$personajeMayorSalario = null;
$maxSalarioPersonaje = -1;
foreach ($personajes as $p) {
    $profId = isset($p->profesion) ? $p->profesion : null;
    if ($profId !== null && isset($profesionesMap[$profId])) {
        $sal = isset($profesionesMap[$profId]->salario_mensual) ? $profesionesMap[$profId]->salario_mensual : 0;
        if ($sal > $maxSalarioPersonaje) {
            $maxSalarioPersonaje = $sal;
            $personajeMayorSalario = $p;
        }
    }
}

// Datos para gráfico: distribución de salarios por categoría de profesión
$salarioPorCategoria = [];
foreach ($profesiones as $prof) {
    if (!isset($salarioPorCategoria[$prof->categoria])) $salarioPorCategoria[$prof->categoria] = [];
    $salarioPorCategoria[$prof->categoria][] = $prof->salario_mensual;
}
$salarioPromedioCategoria = [];
foreach ($salarioPorCategoria as $cat => $sals) {
    $salarioPromedioCategoria[$cat] = count($sals) ? round(array_sum($sals) / count($sals), 2) : 0;
}

plantilla::aplicar();
?>

<div class="container mt-4">
    <h2 class="mb-4">Panel de Estadísticas</h2>
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Personajes</h6>
                    <p class="display-6 mb-0"><?= $totalPersonajes ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Profesiones</h6>
                    <p class="display-6 mb-0"><?= $totalProfesiones ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Edad Promedio</h6>
                    <p class="display-6 mb-0"><?= $edadPromedio ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Salario Promedio</h6>
                    <p class="display-6 mb-0">$<?= number_format($salarioPromedio, 2) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted">Nivel de experiencia más común</h6>
                    <p class="fs-5"><?= $nivelMasComun ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted">Profesión con salario más alto</h6>
                    <p>
                        <?= $profesionMayorSalario ? $profesionMayorSalario->nombre_profesion . " ($" . number_format($profesionMayorSalario->salario_mensual, 2) . ")" : 'N/A' ?>
                    </p>
                    <h6 class="card-title text-muted mt-3">Profesión con salario más bajo</h6>
                    <p>
                        <?= $profesionMenorSalario ? $profesionMenorSalario->nombre_profesion . " ($" . number_format($profesionMenorSalario->salario_mensual, 2) . ")" : 'N/A' ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted">Personaje con salario más alto</h6>
                    <p>
                        <?php if ($personajeMayorSalario && isset($profesionesMap[$personajeMayorSalario->profesion])): ?>
                            <?= $personajeMayorSalario->nombre . ' ' . $personajeMayorSalario->apellido ?>
                            <br>
                            <span class="text-muted">Profesión:</span> <?= $profesionesMap[$personajeMayorSalario->profesion]->nombre_profesion ?>
                            <br>
                            <span class="text-muted">Salario:</span> $<?= number_format($profesionesMap[$personajeMayorSalario->profesion]->salario_mensual, 2) ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">Distribución de personajes por categoría de profesión</h6>
                    <?php if (!empty($categoriaDistribucion) && array_sum($categoriaDistribucion) > 0): ?>
                        <ul class="list-group">
                            <?php foreach ($categoriaDistribucion as $cat => $cant): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= htmlspecialchars($cat) ?>
                                    <span class="badge bg-primary rounded-pill"><?= $cant ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hay datos para mostrar.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">Gráfico de salarios promedio por categoría</h6>
                    <canvas id="graficoSalarios" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('graficoSalarios').getContext('2d');
    const data = {
        labels: <?= json_encode(array_keys($salarioPromedioCategoria)) ?>,
        datasets: [{
            label: 'Salario promedio',
            data: <?= json_encode(array_values($salarioPromedioCategoria)) ?>,
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    };
    new Chart(ctx, config);
});
</script>

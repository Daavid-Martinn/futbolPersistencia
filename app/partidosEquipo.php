<?php
require_once '../templates/menu.php';
require_once '../persistence/PartidoDAO.php';
require_once '../persistence/Connection.php';

$equipo_id = $_GET['id'] ?? null;

if (!$equipo_id) {
    echo "<div class='alert alert-danger'>No se indicó ningún equipo.</div>";
    exit;
}

$conn = new Connection();
$daoP = new PartidoDAO($conn->getConnection());

// Obtener partidos del equipo
$partidos = $daoP->obtenerPartidosPorEquipo($equipo_id);
?>

<h2 class="mb-4">Partidos del equipo</h2>

<?php if (count($partidos) === 0): ?>
    <div class="alert alert-info">Este equipo no tiene partidos registrados.</div>
<?php else: ?>
    <div class="row">
        <?php foreach ($partidos as $p): ?>
            <div class="col-md-4 mb-3">
                <div class="card border-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($p['local']) ?> vs <?= htmlspecialchars($p['visitante']) ?></h5>
                        <p class="card-text mb-1"><strong>Resultado:</strong> <?= htmlspecialchars($p['resultado']) ?></p>
                        <p class="card-text"><strong>Jornada:</strong> <?= htmlspecialchars($p['jornada']) ?></p>
                        <p class="card-text"><strong>Estadio:</strong> <?= htmlspecialchars($p['estadio']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

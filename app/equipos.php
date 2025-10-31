<?php
require_once '../templates/menu.php';
require_once '../persistence/EquipoDAO.php';
require_once '../persistence/Connection.php';

$conn = new Connection();
$dao = new EquipoDAO($conn->getConnection());

// Si se envía el formulario para agregar un equipo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $estadio = trim($_POST['estadio']);
    if ($nombre && $estadio) {
        $dao->insertarEquipo($nombre, $estadio);
    }
}

// Obtener todos los equipos
$equipos = $dao->obtenerEquipos();
?>

<h2 class="mb-4">Equipos de la competición</h2>

<div class="row">
<?php foreach ($equipos as $e): ?>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary"><?= htmlspecialchars($e['nombre']) ?></h5>
                <p class="card-text"><strong>Estadio:</strong> <?= htmlspecialchars($e['estadio']) ?></p>
                
                <!-- Botón para ver los partidos del equipo -->
                <a href="partidosEquipo.php?id=<?= $e['id'] ?>" class="btn btn-outline-primary mt-2">
                    Ver Partidos
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<hr>
<h3>Agregar nuevo equipo</h3>
<form method="POST" class="row g-3">
    <div class="col-md-5">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre del equipo" required>
    </div>
    <div class="col-md-5">
        <input type="text" name="estadio" class="form-control" placeholder="Estadio" required>
    </div>
    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-success">Agregar</button>
    </div>
</form>

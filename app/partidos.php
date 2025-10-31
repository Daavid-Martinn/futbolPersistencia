<?php
require_once '../templates/menu.php';
require_once '../persistence/PartidoDAO.php';
require_once '../persistence/EquipoDAO.php';
require_once '../persistence/Connection.php';

$conn = new Connection();
$daoP = new PartidoDAO($conn->getConnection());
$daoE = new EquipoDAO($conn->getConnection());

$jornadas = $daoP->obtenerJornadas();
$jornadaSel = $_GET['jornada'] ?? ($jornadas[0] ?? 1);
$partidos = $daoP->obtenerPartidosPorJornada($jornadaSel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $local = $_POST['local'];
    $visitante = $_POST['visitante'];
    $resultado = $_POST['resultado'];
    $jornada = $_POST['jornada'];

    if ($daoP->validarPartido($local, $visitante)) {
        $daoP->insertarPartido($local, $visitante, $resultado, $jornada);
        header("Location: partidos.php?jornada=$jornada");
        exit;
    } else {
        echo "<div class='alert alert-warning'>Estos equipos ya han jugado previamente.</div>";
    }
}

$equipos = $daoE->obtenerEquipos();
?>

<h2 class="mb-4">Partidos por jornada</h2>

<form method="GET" class="mb-4">
    <label class="form-label">Selecciona jornada:</label>
    <select name="jornada" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
        <?php foreach ($jornadas as $j): ?>
            <option value="<?= $j ?>" <?= $j == $jornadaSel ? 'selected' : '' ?>>Jornada <?= $j ?></option>
        <?php endforeach; ?>
    </select>
</form>

<div class="row">
<?php foreach ($partidos as $p): ?>
    <div class="col-md-4 mb-3">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($p['local']) ?> vs <?= htmlspecialchars($p['visitante']) ?></h5>
                <p class="card-text mb-1"><strong>Resultado:</strong> <?= htmlspecialchars($p['resultado']) ?></p>
                <p class="card-text"><strong>Estadio:</strong> <?= htmlspecialchars($p['estadio']) ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<hr>
<h3>Agregar nuevo partido</h3>
<form method="POST" class="row g-3">
    <div class="col-md-3">
        <select name="local" class="form-select" required>
            <option value="">Equipo local</option>
            <?php foreach ($equipos as $e): ?>
                <option value="<?= $e['id'] ?>"><?= $e['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <select name="visitante" class="form-select" required>
            <option value="">Equipo visitante</option>
            <?php foreach ($equipos as $e): ?>
                <option value="<?= $e['id'] ?>"><?= $e['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <input type="text" name="resultado" class="form-control" placeholder="1/X/2" required>
    </div>
    <div class="col-md-2">
        <input type="number" name="jornada" class="form-control" placeholder="Jornada" required>
    </div>
    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-success">Agregar partido</button>
    </div>
</form>


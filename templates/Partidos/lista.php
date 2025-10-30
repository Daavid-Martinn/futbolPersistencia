<?php 
// templates/partidos/lista.php
require_once __DIR__ . '/../menu.php'; 
?>

<div class="card p-4">
    <h2 class="card-title"> Resultados de Partidos</h2>

    <form method="GET" action="index.php" class="mb-4">
        <input type="hidden" name="action" value="partidos">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label class="mr-sm-2" for="jornada">Seleccionar Jornada:</label>
            </div>
            <div class="col-auto">
                <select class="custom-select mr-sm-2" id="jornada" name="jornada" onchange="this.form.submit()">
                    <?php 
                    // $jornadas y $jornadaSeleccionada vienen del PartidosController
                    foreach ($jornadas as $j): ?>
                        <option value="<?= htmlspecialchars($j) ?>" <?= ($j == $jornadaSeleccionada) ? 'selected' : '' ?>>
                            Jornada <?= htmlspecialchars($j) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if (empty($jornadas)): ?>
                <div class="col-auto">
                    <p class="text-danger mt-3">No hay partidos registrados.</p>
                </div>
            <?php endif; ?>
        </div>
    </form>
    
    <?php if (!empty($partidos)): ?>
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Jornada</th>
                <th>Partido</th>
                <th>Estadio</th>
                <th>Resultado (1x2)</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($partidos as $partido): ?>
            <tr>
                <td><?= htmlspecialchars($partido['jornada']) ?></td>
                <td><?= htmlspecialchars($partido['local']) ?> vs <?= htmlspecialchars($partido['visitante']) ?></td>
                <td><?= htmlspecialchars($partido['estadio']) ?></td>
                <td class="text-center font-weight-bold">
                    <span class="badge 
                        <?= ($partido['resultado'] === '1') ? 'badge-success' : 
                            (($partido['resultado'] === 'X') ? 'badge-warning' : 'badge-danger') ?>">
                        <?= htmlspecialchars($partido['resultado']) ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <a href="index.php?action=partidos_agregar" class="btn btn-success mt-3">➕ Añadir Nuevo Partido</a>
</div>

<?php require_once __DIR__ . '/../cierre.php'; ?>
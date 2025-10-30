<?php 
// templates/equipos/partidos_equipo.php
require_once __DIR__ . '/../menu.php'; 
?>

<div class="card p-4">
    <h2 class="card-title">Partidos de <?= htmlspecialchars($nombreEquipo ?? 'Equipo Desconocido') ?></h2>

    <?php if (empty($partidos)): ?>
        <div class="alert alert-info mt-3">Este equipo aún no ha jugado ningún partido.</div>
    <?php else: ?>
        <table class="table table-bordered table-sm mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Jornada</th>
                    <th>Local</th>
                    <th>Visitante</th>
                    <th>Estadio</th>
                    <th>Resultado (1X2)</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($partidos as $partido): 
                // Resalta el nombre del equipo actual para que sea más claro
                $local = htmlspecialchars($partido['local']);
                $visitante = htmlspecialchars($partido['visitante']);

                if ($local == $nombreEquipo) {
                    $local = "<strong>{$local}</strong>";
                } elseif ($visitante == $nombreEquipo) {
                    $visitante = "<strong>{$visitante}</strong>";
                }
            ?>
                <tr>
                    <td><?= htmlspecialchars($partido['jornada']) ?></td>
                    <td><?= $local ?></td>
                    <td><?= $visitante ?></td>
                    <td><?= htmlspecialchars($partido['estadio']) ?></td>
                    <td class="text-center">
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
    
    <a href="index.php?action=equipos" class="btn btn-secondary mt-3"> Volver a Equipos</a>
</div>
 
<?php require_once __DIR__ . '/../cierre.php'; ?>
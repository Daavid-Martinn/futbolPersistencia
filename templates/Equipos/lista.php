<?php 
// templates/equipos/lista.php

// 1. Incluye la CABECERA y el MENÚ
require_once __DIR__ . '/../menu.php'; 
?>

<div class="card p-4">
    <h2 class="card-title">Equipos Participantes</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nombre del Equipo</th>
                <th>Estadio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        // $equipos viene del EquiposController->mostrarLista()
        if (!empty($equipos)): 
            foreach ($equipos as $equipo): 
        ?>
            <tr>
                <td><?= htmlspecialchars($equipo->getNombre()) ?></td>
                <td><?= htmlspecialchars($equipo->getEstadio()) ?></td>
                <td>
                    <a href="index.php?action=partidos_equipo&id=<?= htmlspecialchars($equipo->getId()) ?>" class="btn btn-sm btn-info">
                        Ver Partidos
                    </a>
                </td>
            </tr>
        <?php 
            endforeach; 
        else: 
        ?>
            <tr>
                <td colspan="3">No hay equipos registrados.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php?action=equipos_agregar" class="btn btn-primary mt-3"> Agregar Nuevo Equipo</a>
</div>

<?php 
// 2. Incluye el CIERRE HTML y los scripts
require_once __DIR__ . '/../cierre.php'; 
?>
<?php 
// templates/partidos/agregar.php
require_once __DIR__ . '/../menu.php'; 
?>

<div class="card p-4">
    <h2 class="card-title">Registrar Nuevo Partido</h2>
    
    <?php if (isset($error) && !empty($error)): // $error viene del PartidosController ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=partidos_agregar">
        
        <div class="form-group mb-3">
            <label for="jornada">Número de Jornada:</label>
            <input type="number" class="form-control" id="jornada" name="jornada" min="1" required value="<?= $_POST['jornada'] ?? 1 ?>">
        </div>
        
        <div class="form-group mb-3">
            <label for="equipo_local_id">Equipo Local:</label>
            <select class="form-control" id="equipo_local_id" name="equipo_local_id" required>
                <option value="">-- Seleccione equipo --</option>
                <?php 
                // $equipos viene del PartidosController
                foreach ($equipos as $equipo): ?>
                    <option 
                        value="<?= htmlspecialchars($equipo->getId()) ?>" 
                        data-estadio="<?= htmlspecialchars($equipo->getId()) ?>" 
                        <?= (isset($_POST['equipo_local_id']) && $_POST['equipo_local_id'] == $equipo->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($equipo->getNombre()) ?> (Estadio: <?= htmlspecialchars($equipo->getEstadio()) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="equipo_visitante_id">Equipo Visitante:</label>
            <select class="form-control" id="equipo_visitante_id" name="equipo_visitante_id" required>
                <option value="">-- Seleccione equipo --</option>
                <?php foreach ($equipos as $equipo): ?>
                    <option 
                        value="<?= htmlspecialchars($equipo->getId()) ?>"
                        <?= (isset($_POST['equipo_visitante_id']) && $_POST['equipo_visitante_id'] == $equipo->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($equipo->getNombre()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <input type="hidden" id="estadio_id" name="estadio_id" value="">
        
        <script>
        // Copia el ID del equipo local al campo estadio_id
        document.getElementById('equipo_local_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            // Asegura que el valor enviado al DAO para 'estadio_id' sea el ID del equipo local
            document.getElementById('estadio_id').value = selectedOption.value; 
        });
        // Inicializa el valor oculto al cargar la página si ya hay un valor seleccionado
        document.getElementById('equipo_local_id').dispatchEvent(new Event('change'));
        </script>

        <div class="form-group mb-4">
            <label for="resultado">Resultado (Quiniela 1X2):</label>
            <select class="form-control" id="resultado" name="resultado" required>
                <option value="">-- Resultado --</option>
                <option value="1" <?= (isset($_POST['resultado']) && $_POST['resultado'] == '1') ? 'selected' : '' ?>>1 (Gana Local)</option>
                <option value="X" <?= (isset($_POST['resultado']) && $_POST['resultado'] == 'X') ? 'selected' : '' ?>>X (Empate)</option>
                <option value="2" <?= (isset($_POST['resultado']) && $_POST['resultado'] == '2') ? 'selected' : '' ?>>2 (Gana Visitante)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Registrar Partido</button>
        <a href="index.php?action=partidos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
 
<?php require_once __DIR__ . '/../cierre.php'; ?>
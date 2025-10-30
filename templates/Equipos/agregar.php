<?php require_once __DIR__ . '/../menu.php'; ?>

<div class="card p-4">
    <h2 class="card-title">Agregar Nuevo Equipo</h2>
    
    <?php if (isset($error)): // $error viene del EquiposController ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=equipos_agregar">
        <div class="form-group mb-3">
            <label for="nombre">Nombre del Equipo:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group mb-3">
            <label for="estadio">Estadio:</label>
            <input type="text" class="form-control" id="estadio" name="estadio" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Equipo</button>
        <a href="index.php?action=equipos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once __DIR__ . '/../cierre.php'; ?>
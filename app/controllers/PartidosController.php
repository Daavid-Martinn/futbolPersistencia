<?php
// app/controllers/PartidosController.php
namespace App\Controllers;

use App\Models\Partido;
use Persistence\PartidoDAO; // Usa el namespace adaptado
use Persistence\EquipoDAO;  // Usa el namespace adaptado

class PartidosController {
    // ... (El constructor y la lógica son idénticos)

    public function mostrarPartidos() {
        // ... (Lógica idéntica)
        
        // **Ruta de Vista Adaptada**
        require_once __DIR__ . '/../../templates/partidos/lista.php';
    }
    
    public function mostrarPorEquipo($equipoId) {
        // ... (Lógica idéntica)
        
        // **Ruta de Vista Adaptada**
        require_once __DIR__ . '/../../templates/equipos/partidos_equipo.php';
    }

    public function agregar() {
        // ... (Lógica POST idéntica)
        
        // **Ruta de Vista Adaptada**
        require_once __DIR__ . '/../../templates/partidos/agregar.php';
    }
}
<?php
// index.php
require_once 'utils/Autoloader.php';

// Registra el autoloader
Utils\Autoloader::register();

session_start();

use App\Controllers\EquiposController;
use App\Controllers\PartidosController;

// 1. Obtener la acción y el controlador
$action = $_GET['action'] ?? 'home';

// 2. Lógica de SESIÓN (Página de entrada)
// Si no hay acción y la sesión 'last_equipo_id' existe, redirige a PartidosEquipo
if ($action == 'home' && isset($_SESSION['last_equipo_id'])) {
    $action = 'partidos_equipo';
    $_GET['id'] = $_SESSION['last_equipo_id'];
}

// 3. Enrutamiento (Dispatching)
switch ($action) {
    case 'equipos':
        $controller = new EquiposController();
        $controller->mostrarLista();
        break;
        
    case 'equipos_agregar':
        $controller = new EquiposController();
        $controller->agregar();
        break;

    case 'partidos_equipo':
        // Guardar en sesión para la lógica de "página principal"
        $_SESSION['last_equipo_id'] = $_GET['id'] ?? null;
        $controller = new PartidosController();
        $controller->mostrarPorEquipo($_GET['id'] ?? null);
        break;
        
    case 'partidos':
        $controller = new PartidosController();
        $controller->mostrarPartidos();
        break;
        
    case 'partidos_agregar':
        $controller = new PartidosController();
        $controller->agregar();
        break;
        
    case 'home':
    default:
        // Si no se ha consultado un equipo antes, la principal es 'equipos'
        $controller = new EquiposController();
        $controller->mostrarLista();
        break;
}
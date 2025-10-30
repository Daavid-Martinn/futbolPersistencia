<?php
// app/controllers/EquiposController.php
namespace App\Controllers;

use App\Models\Equipo;
use App\Persistence\EquipoDAO; // Usa el namespace adaptado

class EquiposController {
    private $dao;

    public function __construct() {
        $this->dao = new EquipoDAO();
    }

    public function mostrarLista() {
        $equipos = $this->dao->getAll();
        
        // **Ruta de Vista Adaptada**
        require_once __DIR__ . '/../../templates/equipos/lista.php'; 
    }

    public function agregar() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $estadio = trim($_POST['estadio'] ?? '');

            if (empty($nombre) || empty($estadio)) {
                $error = "El nombre y el estadio son obligatorios.";
            } else {
                // El ID es autoincremental, por lo que pasamos null.
                $equipo = new Equipo(null, $nombre, $estadio);
                if ($this->dao->save($equipo)) {
                    header('Location: index.php?action=equipos');
                    exit();
                } else {
                    $error = "Error al guardar el equipo. Inténtelo de nuevo.";
                }
            }
        }
        
        // **Ruta de Vista Adaptada**
        require_once __DIR__ . '/../../templates/equipos/agregar.php'; // Se pasa $error a la vista
    }
}
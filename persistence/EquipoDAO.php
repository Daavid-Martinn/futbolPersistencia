<?php
namespace App\Persistence;

use App\Models\Equipo;
use PDO;

class EquipoDAO {
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT id, nombre, estadio FROM equipos");
        $equiposData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $equipos = [];
        foreach ($equiposData as $data) {
            $equipos[] = new Equipo($data['id'], $data['nombre'], $data['estadio']);
        }
        return $equipos;
    }

    public function save(Equipo $equipo) {
        $stmt = $this->db->prepare("INSERT INTO equipos (nombre, estadio) VALUES (?, ?)");
        return $stmt->execute([$equipo->getNombre(), $equipo->getEstadio()]);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT id, nombre, estadio FROM equipos WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            return new Equipo($data['id'], $data['nombre'], $data['estadio']);
        }
        return null;
    }
}
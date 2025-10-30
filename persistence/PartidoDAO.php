<?php
namespace App\Persistence;

use App\Models\Partido;
use PDO;

class PartidoDAO {
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConnection();
    }

    public function getPartidosByJornada($jornada) {
        // Consulta compleja para obtener nombres de equipos
        $sql = "SELECT p.jornada, e1.nombre AS local, e2.nombre AS visitante, p.resultado, e3.nombre AS estadio
                FROM partidos p
                JOIN equipos e1 ON p.equipo_local_id = e1.id
                JOIN equipos e2 ON p.equipo_visitante_id = e2.id
                JOIN equipos e3 ON p.estadio_id = e3.id
                WHERE p.jornada = ? 
                ORDER BY p.id ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$jornada]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve datos crudos para la vista
    }
    
    public function getJornadas() {
        $stmt = $this->db->query("SELECT DISTINCT jornada FROM partidos ORDER BY jornada ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function getPartidosByEquipoId($equipoId) {
        $sql = "SELECT p.jornada, e1.nombre AS local, e2.nombre AS visitante, p.resultado, e3.nombre AS estadio
                FROM partidos p
                JOIN equipos e1 ON p.equipo_local_id = e1.id
                JOIN equipos e2 ON p.equipo_visitante_id = e2.id
                JOIN equipos e3 ON p.estadio_id = e3.id
                WHERE p.equipo_local_id = ? OR p.equipo_visitante_id = ?
                ORDER BY p.jornada ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$equipoId, $equipoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function save(Partido $partido) {
        $stmt = $this->db->prepare("INSERT INTO partidos (equipo_local_id, equipo_visitante_id, jornada, resultado, estadio_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $partido->getLocalId(), 
            $partido->getVisitanteId(), 
            $partido->getJornada(), 
            $partido->getResultado(),
            $partido->getEstadioId()
        ]);
    }
    
    public function existePartidoPrevio($localId, $visitanteId) {
        // Comprobar si ya han jugado al menos una vez (local vs visitante o viceversa)
        $sql = "SELECT COUNT(*) FROM partidos 
                WHERE (equipo_local_id = ? AND equipo_visitante_id = ?) 
                   OR (equipo_local_id = ? AND equipo_visitante_id = ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$localId, $visitanteId, $visitanteId, $localId]);
        return $stmt->fetchColumn() > 0;
    }
}
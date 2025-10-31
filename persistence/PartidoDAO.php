<?php
class PartidoDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Obtiene todos los partidos
    public function obtenerPartidos() {
        $stmt = $this->conn->query("
            SELECT p.id, p.jornada, p.resultado, 
                   el.nombre AS local, ev.nombre AS visitante,
                   el.estadio AS estadio
            FROM partidos p
            JOIN equipos el ON p.equipo_local_id = el.id
            JOIN equipos ev ON p.equipo_visitante_id = ev.id
            ORDER BY p.jornada
        ");
        return $stmt->fetchAll();
    }

    // Obtener jornadas disponibles
    public function obtenerJornadas() {
        $stmt = $this->conn->query("SELECT DISTINCT jornada FROM partidos ORDER BY jornada ASC");
        return array_column($stmt->fetchAll(), 'jornada');
    }

    // Obtener partidos por jornada
    public function obtenerPartidosPorJornada($jornada) {
        $stmt = $this->conn->prepare("
            SELECT p.id, p.jornada, p.resultado, 
                   el.nombre AS local, ev.nombre AS visitante,
                   el.estadio AS estadio
            FROM partidos p
            JOIN equipos el ON p.equipo_local_id = el.id
            JOIN equipos ev ON p.equipo_visitante_id = ev.id
            WHERE p.jornada = ?
            ORDER BY p.id
        ");
        $stmt->execute([$jornada]);
        return $stmt->fetchAll();
    }

    // Validar que los equipos no hayan jugado previamente
    public function validarPartido($local_id, $visitante_id) {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) as total 
            FROM partidos 
            WHERE (equipo_local_id = ? AND equipo_visitante_id = ?)
               OR (equipo_local_id = ? AND equipo_visitante_id = ?)
        ");
        $stmt->execute([$local_id, $visitante_id, $visitante_id, $local_id]);
        $result = $stmt->fetch();
        return $result['total'] == 0;
    }

    // Insertar nuevo partido
    public function insertarPartido($equipo_local_id, $equipo_visitante_id, $resultado, $jornada) {
        // Tomamos el estadio del equipo local
        $stmt = $this->conn->prepare("SELECT id FROM equipos WHERE id = ?");
        $stmt->execute([$equipo_local_id]);
        $equipo_local = $stmt->fetch();

        if (!$equipo_local) {
            throw new Exception("El equipo local con ID $equipo_local_id no existe.");
        }

        $estadio_id = $equipo_local['id'];

        $stmt = $this->conn->prepare("
            INSERT INTO partidos (equipo_local_id, equipo_visitante_id, resultado, jornada, estadio_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$equipo_local_id, $equipo_visitante_id, $resultado, $jornada, $estadio_id]);
    }

    // Obtener un partido por ID
    public function obtenerPartidoPorId($id) {
        $stmt = $this->conn->prepare("
            SELECT p.id, p.jornada, p.resultado, 
                   el.nombre AS local, ev.nombre AS visitante,
                   el.estadio AS estadio
            FROM partidos p
            JOIN equipos el ON p.equipo_local_id = el.id
            JOIN equipos ev ON p.equipo_visitante_id = ev.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // NUEVA FUNCIÓN: Obtener todos los partidos de un equipo (local o visitante)
    public function obtenerPartidosPorEquipo($equipo_id) {
        $stmt = $this->conn->prepare("
            SELECT p.id, p.jornada, p.resultado, 
                   el.nombre AS local, ev.nombre AS visitante,
                   el.estadio AS estadio
            FROM partidos p
            JOIN equipos el ON p.equipo_local_id = el.id
            JOIN equipos ev ON p.equipo_visitante_id = ev.id
            WHERE p.equipo_local_id = ? OR p.equipo_visitante_id = ?
            ORDER BY p.jornada, p.id
        ");
        $stmt->execute([$equipo_id, $equipo_id]);
        return $stmt->fetchAll();
    }
}

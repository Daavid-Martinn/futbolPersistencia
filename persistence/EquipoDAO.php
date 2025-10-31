<?php
class EquipoDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerEquipos() {
        $stmt = $this->conn->query("SELECT * FROM equipos ORDER BY nombre");
        return $stmt->fetchAll();
    }

    public function insertarEquipo($nombre, $estadio) {
        $stmt = $this->conn->prepare("INSERT INTO equipos (nombre, estadio) VALUES (?, ?)");
        $stmt->execute([$nombre, $estadio]);
    }

    public function obtenerEquipoPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM equipos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}


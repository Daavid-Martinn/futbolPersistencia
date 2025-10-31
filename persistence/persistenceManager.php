<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/EquipoDAO.php';
require_once __DIR__ . '/PartidoDAO.php';

class PersistenceManager {
    private $connection;
    private $equipoDAO;
    private $partidoDAO;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function getEquipoDAO() {
        if (!$this->equipoDAO) {
            $this->equipoDAO = new EquipoDAO($this->connection->getConnection());
        }
        return $this->equipoDAO;
    }

    public function getPartidoDAO() {
        if (!$this->partidoDAO) {
            $this->partidoDAO = new PartidoDAO($this->connection->getConnection());
        }
        return $this->partidoDAO;
    }
}

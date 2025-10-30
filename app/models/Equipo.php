<?php
namespace App\Models;

class Equipo {
    private $id;
    private $nombre;
    private $estadio;

    public function __construct($id, $nombre, $estadio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->estadio = $estadio;
    }
    
    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getEstadio() { return $this->estadio; }
}
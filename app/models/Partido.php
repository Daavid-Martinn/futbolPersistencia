<?php
namespace App\Models;

class Partido {
    private $localId;
    private $visitanteId;
    private $jornada;
    private $resultado;
    private $estadioId;

    public function __construct($localId, $visitanteId, $jornada, $resultado, $estadioId) {
        $this->localId = $localId;
        $this->visitanteId = $visitanteId;
        $this->jornada = $jornada;
        $this->resultado = $resultado;
        $this->estadioId = $estadioId;
    }
    
    // Getters
    public function getLocalId() { return $this->localId; }
    public function getVisitanteId() { return $this->visitanteId; }
    public function getJornada() { return $this->jornada; }
    public function getResultado() { return $this->resultado; }
    public function getEstadioId() { return $this->estadioId; }
}
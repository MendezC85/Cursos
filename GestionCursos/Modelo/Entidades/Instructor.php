<?php

class Instructor implements JsonSerializable{
    private $id;
    private $nombre;
    private $cedula;  
    private $estado;
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }


    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula): void {
        $this->cedula = $cedula;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'estado' => $this->estado
        ];
    }
    
    
}

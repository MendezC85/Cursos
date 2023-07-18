<?php

class Categoria implements JsonSerializable{
    private $id;
    private $descripcion;
    private $estado;
    
    public function getId() {
        return $this->id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
        ];
    }

}

<?php

class Curso implements JsonSerializable{
    private $id;
    private $titulo;
    private $descripcion;
    private $idCategoria;
    private $idInstructor;
    private $img;
    private $estado;
    
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

        public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria): void {
        $this->idCategoria = $idCategoria;
    }

        public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }



    public function getIdInstructor() {
        return $this->idInstructor;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setIdInstructor($idInstructor): void {
        $this->idInstructor = $idInstructor;
    }
    
    public function getImg() {
        return $this->img;
    }

    public function setImg($img): void {
        $this->img = $img;
    }

    
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'idCategoria' => $this->idCategoria,
            'idInstructor' => $this->idInstructor,
            'estado' => $this->estado,
            'img' => $this->img
        ];
    }
}

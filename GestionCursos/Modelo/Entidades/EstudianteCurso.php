<?php

class EstudianteCurso {
    private $id;
    private $idEstudiante;
    private $idCurso;
    private $estado;
    
    public function getId() {
        return $this->id;
    }

    public function getIdEstudiante() {
        return $this->idEstudiante;
    }

    public function getIdCurso() {
        return $this->idCurso;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdEstudiante($idEstudiante): void {
        $this->idEstudiante = $idEstudiante;
    }

    public function setIdCurso($idCurso): void {
        $this->idCurso = $idCurso;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }



}

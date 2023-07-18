<?php

class Estudiante {
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

    public function getCorreo() {
        return $this->correo;
    }


    public function getIdTipo() {
        return $this->IdTipo;
    }

    public function setIdTipo($IdTipo): void {
        $this->IdTipo = $IdTipo;
    }

        public function getContrasena() {
        return $this->contrasena;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setCorreo($correo): void {
        $this->correo = $correo;
    }

    public function setContrasena($contrasena): void {
        $this->contrasena = $contrasena;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula): void {
        $this->cedula = $cedula;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    } 
    
}

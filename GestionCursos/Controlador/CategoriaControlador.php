<?php

require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Categoria.php';
require_once './Modelo/Metodos/CategoriaM.php';

class CategoriaControlador {
    private function Validar()
    {
        $band = true;
        if($_SESSION["idInstructor"]){
            $insM = new InstructorM();
            $ins = $insM->BuscarId($_SESSION["idInstructor"]);    
            $return = $ins;
            if($ins==null)
                $return = false;
        }
        if(!$return)
            header("Location:./index.php");
        
        return $return;
    }
    
    public function Todos() {
        $this->Validar();
        $catM = new CategoriaM();
        $todos = $catM->Todos();
        var_dump($todos);
        /*require_once '';*/
    }
    
    public function Crear() {
        $this->Validar();
        $cat = new Categoria();
        $cat->setDescripcion($_POST["NOMBRE"]);
        
        //mandar a BD
        $catM = new CategoriaM();
        
        if($catM->Crear($cat))
        {
            header("Location: ./index.php?controlador=Categoria&accion=Todos");
        }
        
    }
    public function BuscarId() {
        $this->Validar();
        $catM = new CategoriaM();
        $categoria = new Categoria;
        $categoria = $catM->BuscarId($_POST["ID"]);
        var_dump($categoria);
        /*require_once '';*/
    }
    public function Actualizar() {
        $this->Validar();
        $catM = new CategoriaM();
        $cat = new Categoria();
        $id = $_POST["ID"];
        $descripcion = $_POST["DESCRIPCION"];
        
        if(isset($id)){
            
            $cat = $catM->BuscarId($id);
            if(isset($cat)){
                
                $cat->setDescripcion($descripcion);
                if($catM->Actualizar($cat))
                {
                    header("Location: ./index.php?controlador=Categoria&accion=Todos");
                }
            }
        }   
    }
    public function Desactivar(){
        $this->Validar();
        $catM = new CategoriaM();
        $id = $_POST["ID"]; 
        if(isset($id)){
            $catM->Desactivar($id);
        }
    }
    
    public function Activar(){
        $this->Validar();
        $catM = new CategoriaM();
        $id = $_POST["ID"]; 
        if(isset($id)){
            $catM->Activar($id);
        }
    }
}

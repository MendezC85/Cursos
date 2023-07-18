<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Estudiante.php';
require_once './Modelo/Metodos/EstudianteM.php';
require_once './Modelo/Entidades/Curso.php';
require_once './Modelo/Metodos/CursoM.php';
require_once './Modelo/Entidades/EstudianteCurso.php';
require_once './Modelo/Metodos/EstudianteCursoM.php';


class EstudianteControlador 
{
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
        $estM = new EstudianteM();
        $todos = $estM->Todos();
        
        var_dump($todos);
        /*require_once '';*/
    }
    
    public function Crear() {
        $this->Validar();
        $est = new Estudiante();
        
        $est->setCedula($_POST["CEDULA"]);
        $est->setNombre($_POST["NOMBRE"]);
        $est->setCorreo($_POST["CORREO"]);
        $est->setContrasena(password_hash($_POST["CONTRASENA"], PASSWORD_DEFAULT));
        
        
        //mandar a BD
        $estM = new EstudianteM();
       
        if($estM->Crear($est))
        {
            header("Location: ./index.php?controlador=Estudiante&accion=Todos");
        }
        
    }
    public function BuscarId() {
        $this->Validar();
        $estM = new EstudianteM();
        $est = new Estudiante;
        $est = $estM->BuscarId($_POST["ID"]);
        /*require_once '';*/
    }
    public function Actualizar() {
        $this->Validar();
        $estM = new EstudianteM();
        $est = new Estudiante; 
        $id = $_POST["ID"];
        
        if(isset($id)){
            
            $est = $estM->BuscarId($id);
            
            if(isset($est)){
                
               $est->setCedula($_POST["CEDULA"]);
               $est->setNombre($_POST["NOMBRE"]);
               $est->setCorreo($_POST["CORREO"]);
                
                if($estM->Actualizar($est)) 
                {
                    header("Location: ./index.php?controlador=Instructor&accion=Todos");
                }
            }
        }   
    }
    public function Desactivar(){
        $this->Validar();
        $estM = new EstudianteM();
        $id = $_POST["ID"]; 
        if(isset($id)){
            $estM->Desactivar($id);
            header("Location: ./index.php?controlador=Estudiante&accion=Todos");
        }
    }
    
    public function Activar(){
        $this->Validar();
        $estM = new EstudianteM();
        $id = $_POST["ID"]; 
        if(isset($id)){
            $estM->Activar($id);
            header("Location: ./index.php?controlador=Estudiante&accion=Todos");
        }
    }
    
}

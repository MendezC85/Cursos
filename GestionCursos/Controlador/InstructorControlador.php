<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Instructor.php';
require_once './Modelo/Metodos/InstructorM.php';
class InstructorControlador {
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
        $insM = new InstructorM();
        $todos = $insM->Todos();
        
        var_dump($todos);
        /*require_once '';*/
    }
    
    public function Crear() {
        $this->Validar();
        $ins = new Instructor();
        
        $ins->setCedula($_POST["CEDULA"]);
        $ins->setNombre($_POST["NOMBRE"]);
        $ins->setCorreo($_POST["CORREO"]);
        $ins->setContrasena(password_hash($_POST["CONTRASENA"], PASSWORD_DEFAULT));
        
        
        //mandar a BD
        $insM = new InstructorM();
       
        if($insM->Crear($ins))
        {
            header("Location: ./index.php?controlador=Instructor&accion=Todos");
        }
        
    }
    public function BuscarId() {
        $this->Validar();
        $insM = new InstructorM();
        $ins = new Instructor;
        $ins = $insM->BuscarId($_POST["ID"]);
        
        var_dump($ins); 
        /*require_once '';*/
    }
    public function Actualizar() {
        $this->Validar();
        $insM = new InstructorM();
        $ins = new Instructor; 
        $id = $_POST["ID"];
        
        if(isset($id)){
            
            $ins = $insM->BuscarId($id);
            
            if(isset($ins)){
                
               $ins->setCedula($_POST["CEDULA"]);
               $ins->setNombre($_POST["NOMBRE"]);
               $ins->setCorreo($_POST["CORREO"]);
                
                if($insM->Actualizar($ins)) 
                {
                    header("Location: ./index.php?controlador=Instructor&accion=Todos");
                }
            }
        }   
    }
    public function Desactivar(){
        $this->Validar();
        $insM = new InstructorM();
        $id = $_POST["ID"]; 
        if(isset($id)){
            $insM->Desactivar($id);
            header("Location: ./index.php?controlador=Instructor&accion=Todos");
        }
    }
    
    public function Activar(){
        $this->Validar();
        $insM = new InstructorM();
        $id = $_POST["ID"]; 
        if(isset($id)){
            $insM->Activar($id);
            header("Location: ./index.php?controlador=Instructor&accion=Todos");
        }
    }
}

<?php
session_start();

class IndexControlador {
    
    function Index(){
        echo "Index";
    }
    function Ingreso()
    {
        $correo=/*$_POST['CORREO']*/"jose@gmail.com";
        $contrasena =/*$_POST['CONTRASENA']*/123;
        $e = new Estudiante();
        $eM= new EstudianteM();
        
        $ins = new Instructor();
        $insM = new InstructorM();
        if(($e=$eM->BuscarCorreo($correo))!=null)
        {
           if(password_verify($contrasena, $e->getContrasena()))
           {
             
                $_SESSION["idEstudiante"]=$e->getId();
               //header("Location:./index.php?controlador=Estudiante&accion=");
           }    
        }
        else if(($ins=$insM->BuscarCorreo($correo))!=null)
        {
           if(password_verify($contrasena, $ins->getContrasena()))
           {
               
               $_SESSION["idInstructor"]=$ins->getId();
               //header("Location:./index.php?controlador=estudiante&accion=Menu");
           }
          
        }
        
    }
    
    function Cerrar()
    {
        session_destroy();
        header ("Location:./index.php");
    }
}

<?php

class EstudianteM 
{
    function Todos()
    {
        $retVal=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM `CARLOSESTUDIANTE`;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $e=new Estudiante();
                $e->setId($fila["ID"]);
                $e->setCedula($fila["CEDULA"]);
                $e->setNombre($fila["NOMBRE"]);
                $e->setEstado($fila["ESTADO"]);
                $retVal[]=$e;
            }
        }
        else
            $retVal=null;
        $conexion->Cerrar();        
        return $retVal;
    }
    
    function BuscarId($id)
    {
        $e= new Estudiante();
        $conexion=new Conexion();
        
        $sql="SELECT * FROM `CARLOSESTUDIANTE` WHERE `ID`=$id AND `ESTADO` = 1;";
        
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $e->setId($fila["ID"]);
                $e->setCedula($fila["CEDULA"]);
                $e->setNombre($fila["NOMBRE"]);
                $e->setEstado($fila["ESTADO"]);                
            }
        }
        else
            $e=null;
        $conexion->Cerrar();
        
        return $e;        
    }
   
    function Crear(Estudiante $e)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="INSERT INTO `CARLOSESTUDIANTE`"
                . "(`CEDULA`, "
                . "`NOMBRE`)"
                . "VALUES "
                . "('".$e->getCedula()."',"
                . "'".$e->nombre()."')";
        
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    function Desactivar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSESTUDIANTE` SET `ESTADO`='"."FALSE"."' WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
  
    function Actualizar(Estudiante $e)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSESTUDIANTE` SET "
                . "`CEDULA`='".$e->getCedula()."',"
                . "`CORREO`='".$e->nombre()."' WHERE `ID`=".$e->getId();
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }

}

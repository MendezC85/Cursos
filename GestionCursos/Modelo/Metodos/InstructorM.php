<?php

class InstructorM {
    function Todos()
    {
        $retVal=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM `CARLOSINSTRUCTOR`;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $i = new Instructor();
                $i->setId($fila["ID"]);
                $i->setCedula($fila["CEDULA"]);
                $i->setNombre($fila["NOMBRE"]);
                $i->setEstado($fila["ESTADO"]);
                $i->jsonSerialize();
                $retVal[]=$i;
            }
        }
        else
            $retVal=null;
        $conexion->Cerrar();        
        return $retVal;
    }
    
    function BuscarId($id)
    {
        $ins= new Instructor();
        $conexion=new Conexion();
        
        $sql="SELECT * FROM `CARLOSINSTRUCTOR` WHERE `ID`= $id AND `ESTADO` = 1;";
        
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $ins->setId($fila["ID"]);
                $ins->setCedula($fila["CEDULA"]);
                $ins->setNombre($fila["NOMBRE"]);
                $ins->setEstado($fila["ESTADO"]);           
            }
        }
        else
            $e=null;
        $conexion->Cerrar();
        
        return $ins;        
    }
    
    function Crear(Instructor $ins)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="INSERT INTO `CARLOSINSTRUCTOR`"
                . "(`CEDULA`,"
                . " `NOMBRE`,"
                . " `CORREO`,"
                . " `CONTRASENA`) "
                . "VALUES "
                . "('".$ins->getCedula()."',"
                . "'".$ins->getNombre()."')";
        
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    function Actualizar(Instructor $ins)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSINSTRUCTOR` SET "
                . "`CEDULA`='".$ins->getCedula()."',"
                . "`NOMBRE`='".$ins->getNombre()."',"
                . "`CORREO`='".$ins->getCorreo()."' "
                . "WHERE `ID` =".$ins->getId();
        
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    function Desactivar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSINSTRUCTOR` SET `ESTADO`=FALSE WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
  
    function Activar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSINSTRUCTOR` SET `ESTADO`=TRUE WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
}

<?php

class CategoriaM {
    function Todos()
    {
        $retVal=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM `CARLOSCATEGORIA`;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $c= new Categoria();
                $c->setId($fila["ID"]);
                $c->setDescripcion($fila["DESCRIPCION"]);
                $c->setEstado($fila["ESTADO"]);
                $c->jsonSerialize();
                $retVal[]=$c;
                
            }
        }
        else
            $retVal=null;
        $conexion->Cerrar();        
        return $retVal;
    }
    
    function BuscarId($id)
    {
        $c= new Categoria();
        $conexion= new Conexion();
        
        $sql="SELECT * FROM `CARLOSCATEGORIA` WHERE `ID`= $id AND `ESTADO` = 1;";
        
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $c->setId($fila["ID"]);
                $c->setDescripcion($fila["DESCRIPCION"]);
                $c->setEstado($fila["ESTADO"]);
            }
        }
        else
            $e=null;
        $conexion->Cerrar();
        
        return $c;        
    }function Crear(Categoria $c)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="INSERT INTO `CARLOSCATEGORIA`(`DESCRIPCION`) VALUES ('".$c->getDescripcion()."')";
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
  
    function Actualizar(Categoria $c)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSCATEGORIA` SET `DESCRIPCION`='".$c->getDescripcion()."' WHERE `ID` =".$c->getId();
        
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    
    function Desactivar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSCATEGORIA` SET `ESTADO`='"."FALSE"."' WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    
    function Activar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSCATEGORIA` SET `ESTADO`='"."TRUE"."' WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        
        return $retVal;
    }
    
}

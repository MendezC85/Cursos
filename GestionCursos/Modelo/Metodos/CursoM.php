<?php

class CursoM {
    function Todos()
    {
        $retVal=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM `CARLOSCURSO` WHERE `ESTADO`= TRUE;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $c= new Curso();
                $c->setId($fila["ID"]);
                $c->setTitulo($fila["TITULO"]);
                $c->setDescripcion($fila["DESCRIPCION"]);
                $c->setIdCategoria($fila["IDCATEGORIA"]);
                $c->setIdInstructor($fila["IDINSTRUCTOR"]);
                $c->setImg($fila["IMG"]);
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
        $c= new Curso();
        $conexion= new Conexion();
        
        $sql="SELECT * FROM `CARLOSCURSO` WHERE `ID`= $id AND `ESTADO` = 1;";
        
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $c->setId($fila["ID"]);
                $c->setTitulo($fila["TITULO"]);
                $c->setDescripcion($fila["DESCRIPCION"]);
                $c->setIdCategoria($fila["IDCATEGORIA"]);
                $c->setIdInstructor($fila["IDINSTRUCTOR"]);
                $c->setImg($fila["IMG"]);
                $c->setEstado($fila["ESTADO"]);
                $c->jsonSerialize();
            }
        }
        else
            $e=null;
        $conexion->Cerrar();
        return $c;        
    }
    function Crear(Curso $c)
    {
        
        $retVal=false;
        $conexion= new Conexion();
        $sql="INSERT INTO `CARLOSCURSO`( 
                            `TITULO`, 
                            `DESCRIPCION`, 
                            `IDCATEGORIA`, 
                            `IDINSTRUCTOR`, 
                            `IMG`) 
                            VALUES ('".$c->getTitulo()."',
                            '".$c->getDescripcion()."',
                            '".$c->getIdCategoria()."',
                            '".$c->getIdInstructor()."',
                            '".$c->getImg()."')";
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        var_dump($c->getImg());
        return $retVal;
    }
  
    function Actualizar(Curso $c)
    {
        $retVal=false;
        echo 1;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSCURSO` SET "
                . "`TITULO`='".$c->getTitulo()."',"
                . "`DESCRIPCION`='".$c->getDescripcion()."',"
                . "`IDCATEGORIA`='".$c->getIdCategoria()."',"
                . "`IMG`='".$c->getImg()."',"
                . "`IDINSTRUCTOR`='".$c->getIdInstructor()."'"
                . " WHERE `ID`= ".$c->getId();
        
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    
    function Desactivar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSCURSO` SET `ESTADO`='"."FALSE"."' WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    
    function Activar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSCURSO` SET `ESTADO`= TRUE WHERE `ID`=".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        echo $retVal;
        return $retVal;
    }
}


<?php

class EstudianteCursoM {
    function Todos()
    {
        $retVal=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM `CARLOSESTUDIANTECURSO`;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $e=new EstudianteCurso();
                $e->setId($fila["ID"]);
                $e->setIdCurso($fila["IDCURSO"]);
                $e->setIdEstudiante($fila["IDESTUDIANTE"]);
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
        
        $sql="SELECT * FROM `CARLOSESTUDIANTE` WHERE `ID`=$id AND WHERE `ESTADO` = 1;";
        
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $e->setId($fila["ID"]);
                $e->setIdCurso($fila["IDCURSO"]);
                $e->setIdEstudiante($fila["IDESTUDIANTE"]);
                $e->setEstado($fila["ESTADO"]);                          
            }
        }
        else
            $e=null;
        $conexion->Cerrar();
        
        return $e;        
    }
    function BuscarCurso($idCurso)
    {
        $retVal=array();
        $ec= new EstudianteCurso();
        $conexion=new Conexion();
        $sql="SELECT ec.ID, ec.IDCURSO, ec.IDESTUDIANTE, ec.ESTADO FROM `CARLOSESTUDIANTECURSO` ec INNER JOIN CARLOSCURSO c ON ec.IDCURSO = c.ID WHERE ec.IDCURSO =".$idCurso;
        
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $ec->setId($fila["ID"]);
                $ec->setIdCurso($fila["IDCURSO"]);
                $ec->setIdEstudiante($fila["IDESTUDIANTE"]);
                $ec->setEstado($fila["ESTADO"]);                        
                $retVal[]=$ec;
            }
        }
        else
            $e=null;
        $conexion->Cerrar();
        
        return $retVal;        
    }
    function Crear(EstudianteCurso $ec)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="INSERT INTO `CARLOSESTUDIANTECURSO`("
                . "`IDCURSO`,"
                . " `IDESTUDIANTE`) "
                . "VALUES ("
                . "'".$ec->getIdCurso()."',"
                . "'".$ec->getIdEstudiante()."')";
        
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
    function Desactivar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSESTUDIANTECURSO` SET `ESTADO`='"."FALSE"."' WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }
  
    function Activar($id)
    {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE `CARLOSESTUDIANTECURSO` SET `ESTADO`=TRUE WHERE `ID` = ".$id;
        if($conexion->Ejecutar($sql))
            $retVal=true;
        $conexion->Cerrar();
        return $retVal;
    }


}

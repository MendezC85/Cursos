<?php


class Conexion 
{
    private $mysqli;
    
    function Ejecutar($query)
    {
        $name="prueba12g";
        $user="prueba12g";
        $pass="0Y1w03fo#";
        
        if(!$this->mysqli=new mysqli("localhost",$user,$pass,$name))
        {
            die("Error de conexion (". mysqli_connect_errno().") ". mysqli_connect_error());
        }
        
        $this->mysqli->autocommit(TRUE);
        $resultado= $this->mysqli->query($query);
        return $resultado;
    }
    
    function Cerrar()
    {
        $this->mysqli->close();
    }
}

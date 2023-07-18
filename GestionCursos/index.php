<?php
    
    require_once './Core/RutaFija.php';
    require_once './Core/Rutas.php';
    
    $ruta= new Rutas();
    
    if(isset($_GET['controlador']))
    {
        $controlador=$ruta->CargarControlador($_GET['controlador']);
        if(isset($_GET['accion']))
        {
            $ruta->CargarAccion($controlador, $_GET['accion']);
        }
        else
        {
            $ruta->CargarAccion($controlador, ACCION_PRINCIPAL);
        }
    }
    else
    {
        $controlador=$ruta->CargarControlador(CONTROLADOR_PRINCIPAL);
        $ruta->CargarAccion($controlador, ACCION_PRINCIPAL);
    }


<?php
    require '../../model/modelo_empleado.php';

    date_default_timezone_set('America/Guayaquil');

    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $MU = new Modelo_Empleado();
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES,'UTF-8');
    $provincia = htmlspecialchars($_POST['provincia'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Registrar_Empleado($nombre,$apellido,$provincia,$direccion,$fechaActual);
    
    echo json_encode($consulta);
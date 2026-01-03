<?php
    require '../../model/modelo_usuario.php';

    date_default_timezone_set('America/Guayaquil');

    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $MU = new Modelo_Usuario();
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $contra = password_hash($_POST['contrasena'],PASSWORD_DEFAULT,['cost'=>12]);
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
    $empleado = htmlspecialchars($_POST['empleado'],ENT_QUOTES,'UTF-8');
    $rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Registrar_Usuario($usuario,$contra,$empleado,$email,$rol,$fechaActual);
    
    echo json_encode($consulta);
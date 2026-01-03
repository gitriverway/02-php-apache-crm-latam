<?php
    require '../../model/modelo_empleado.php';

    $MU = new Modelo_Empleado();
    $idEmpleado = htmlspecialchars($_POST['idEmpleado'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES,'UTF-8');
    $provincia = htmlspecialchars($_POST['provincia'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Datos_Empleado($idEmpleado,$nombre,$apellido,$provincia,$direccion);

    echo json_encode($consulta);
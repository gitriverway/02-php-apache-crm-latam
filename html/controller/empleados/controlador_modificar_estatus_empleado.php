<?php
    require '../../model/modelo_empleado.php';

    $MU = new Modelo_Empleado();
    $id = htmlspecialchars($_POST['activarId'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['activarEstatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_Estatus_Empleado($id,$estatus);
    echo json_encode($consulta);
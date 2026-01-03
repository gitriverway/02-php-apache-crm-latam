<?php
    require '../../model/modelo_empleado.php';
    
    $MU = new Modelo_Empleado();
    $idEmpleado = htmlspecialchars($_POST['idEmpleado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->TraerDatosEmpleado($idEmpleado);

    echo json_encode($consulta);
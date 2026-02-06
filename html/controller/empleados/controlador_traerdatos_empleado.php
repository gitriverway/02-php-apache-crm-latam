<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_empleado.php';
    
    $MU = new Modelo_Empleado();
    $idEmpleado = htmlspecialchars($_POST['idEmpleado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->TraerDatosEmpleado($idEmpleado);

    echo json_encode($consulta);
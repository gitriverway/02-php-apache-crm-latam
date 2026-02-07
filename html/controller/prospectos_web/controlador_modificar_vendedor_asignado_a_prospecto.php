<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_prospecto_web.php';

    $MU = new Modelo_Prospecto_Web();
    $idProspecto = htmlspecialchars($_POST['idProspecto'],ENT_QUOTES,'UTF-8');
    $idEmpleado = htmlspecialchars($_POST['idEmpleado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Vendedor_Asigando_Prospecto_Web($idProspecto,$idEmpleado);
    echo json_encode($consulta);
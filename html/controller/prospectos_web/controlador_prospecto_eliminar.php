<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_prospecto_web.php';

    $MU = new Modelo_Prospecto_Web();

    $idProspecto = $_POST['idProspecto'];
    
    $consulta = $MU->Eliminar_Prospecto_Web($idProspecto);
    
    echo json_encode($consulta);
<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_provincia.php';
    $MU = new Modelo_Provincia();
    $consulta = $MU->listar_combo_provincia();
    echo json_encode($consulta);
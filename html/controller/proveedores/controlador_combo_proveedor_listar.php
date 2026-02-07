<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_proveedor.php';

    $MU = new Modelo_Proveedor();
    $consulta = $MU->listar_combo_proveedor();
    echo json_encode($consulta);
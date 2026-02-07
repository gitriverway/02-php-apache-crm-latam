<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_categoria.php';
    $MU = new Modelo_Categoria();
    $consulta = $MU->listar_combo_categoria();
    echo json_encode($consulta);
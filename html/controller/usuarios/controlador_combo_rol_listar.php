<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_usuario.php';

    $MU = new Modelo_Usuario();
    $consulta = $MU->listar_combo_rol();
    echo json_encode($consulta);
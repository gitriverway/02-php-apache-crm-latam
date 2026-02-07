<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_ciudad.php';
    $MU = new Modelo_Ciudad();

    $idProvincia = htmlspecialchars($_POST['idProvincia'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->listar_combo_ciudad($idProvincia);
    echo json_encode($consulta);
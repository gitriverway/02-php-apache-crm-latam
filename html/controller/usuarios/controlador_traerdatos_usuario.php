<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_usuario.php';
    
    $MU = new Modelo_Usuario();
    $idUsuario = htmlspecialchars($_POST['idUsuario'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->TraerDatosUsuario($idUsuario);

    echo json_encode($consulta);
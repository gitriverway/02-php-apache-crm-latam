<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

require '../../model/modelo_usuario.php';

$MU = new Modelo_Usuario();

$usuario = htmlspecialchars($_POST['user'],ENT_QUOTES,'UTF-8');
$password = htmlspecialchars($_POST['pass'],ENT_QUOTES,'UTF-8');

$consulta = $MU->VerificarUsuario($usuario,$password);

    if(count($consulta) > 0){
        echo json_encode($consulta);
    }else{
        echo 0;
    }
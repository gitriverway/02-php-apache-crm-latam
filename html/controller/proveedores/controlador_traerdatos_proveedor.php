<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_proveedor.php';
    
    $MU = new Modelo_Proveedor();
    $idProveedor = htmlspecialchars($_POST['idProveedor'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->TraerDatosProveedor($idProveedor);

    echo json_encode($consulta);
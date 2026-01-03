<?php
    require '../../model/modelo_reembolso_cliente.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Reembolso_Cliente();

    $consulta = $MU->traer_reembolso_unico($idReembolso,$idContrato);

    echo json_encode($consulta);
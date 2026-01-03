<?php
    require '../../model/modelo_operatorio_cliente.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idOperatorio = htmlspecialchars($_POST['idOperatorio'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Operatorio_Cliente();

    $consulta = $MU->traer_operatorio_unico($idOperatorio,$idContrato);

    echo json_encode($consulta);
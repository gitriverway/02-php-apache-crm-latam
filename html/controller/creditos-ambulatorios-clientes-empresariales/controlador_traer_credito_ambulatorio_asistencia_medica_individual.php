<?php
    require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();

    $consulta = $MU->traer_credito_ambulatorio_unico($idCreditoAmbulatorio,$idContrato);

    echo json_encode($consulta);
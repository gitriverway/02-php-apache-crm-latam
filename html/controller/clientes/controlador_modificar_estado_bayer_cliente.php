<?php
    require '../../model/modelo_bayer_persona.php';

    $MU = new Modelo_Bayer_Persona();
    $idCliente = htmlspecialchars($_POST['idCliente'],ENT_QUOTES,'UTF-8');
    $estadoBayer = htmlspecialchars($_POST['estadoBayer'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Estado_Bayer_Cliente($idCliente,$estadoBayer);
    echo json_encode($consulta);
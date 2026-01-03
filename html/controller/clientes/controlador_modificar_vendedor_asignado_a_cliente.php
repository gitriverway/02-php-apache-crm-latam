<?php
    require '../../model/modelo_bayer_persona.php';

    $MU = new Modelo_Bayer_Persona();
    $idCliente = htmlspecialchars($_POST['idCliente'],ENT_QUOTES,'UTF-8');
    $idEmpleado = htmlspecialchars($_POST['idEmpleado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Vendedor_Asigando_Cliente($idCliente,$idEmpleado);
    echo json_encode($consulta);
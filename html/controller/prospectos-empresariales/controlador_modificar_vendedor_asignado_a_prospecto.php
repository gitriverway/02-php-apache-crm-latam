<?php
    require '../../model/modelo_bayer_persona_empresarial.php';

    $idProspecto = htmlspecialchars($_POST['idProspecto'],ENT_QUOTES,'UTF-8');
    $idEmpleado = htmlspecialchars($_POST['idEmpleado'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Bayer_Persona_Empresarial();
    $consulta = $MU->Modificar_Vendedor_Asigando_Cliente($idProspecto,$idEmpleado);
    echo json_encode($consulta);
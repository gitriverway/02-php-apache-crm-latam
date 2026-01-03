<?php
    require '../../model/modelo_bayer_persona_empresarial.php';
    
    $idProspecto = htmlspecialchars($_POST['idProspecto'],ENT_QUOTES,'UTF-8');
    $estadoBayer = htmlspecialchars($_POST['estadoBayer'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Bayer_Persona_Empresarial();
    $consulta = $MU->Modificar_Estado_Bayer_Cliente($idProspecto,$estadoBayer);
    echo json_encode($consulta);
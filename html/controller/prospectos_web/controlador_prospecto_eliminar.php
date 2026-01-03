<?php
    require '../../model/modelo_prospecto_web.php';

    $MU = new Modelo_Prospecto_Web();

    $idProspecto = $_POST['idProspecto'];
    
    $consulta = $MU->Eliminar_Prospecto_Web($idProspecto);
    
    echo json_encode($consulta);
<?php
    require '../../model/modelo_bloqueo_ip.php';

    $MU = new Modelo_Bloqueo_Ip();
    $id = htmlspecialchars($_POST['activarId'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['activarEstatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_Estado_Bloqueo_Ip($id,$estatus);
    echo json_encode($consulta);
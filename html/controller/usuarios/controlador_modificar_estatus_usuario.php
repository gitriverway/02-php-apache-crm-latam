<?php
    require '../../model/modelo_usuario.php';

    $MU = new Modelo_Usuario();
    $id = htmlspecialchars($_POST['activarId'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['activarEstatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_Estatus_Usuario($id,$estatus);
    echo json_encode($consulta);
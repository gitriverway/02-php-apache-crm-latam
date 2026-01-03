<?php
    require '../../model/modelo_usuario.php';
    session_start();
    $MU = new Modelo_Usuario();
    $consulta = $MU->listar_combo_empleado();
    echo json_encode($consulta);
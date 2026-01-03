<?php
    require '../../model/modelo_provincia.php';
    $MU = new Modelo_Provincia();
    $consulta = $MU->listar_combo_provincia();
    echo json_encode($consulta);
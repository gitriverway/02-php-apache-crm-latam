<?php
    require '../../model/modelo_proveedor.php';

    $MU = new Modelo_Proveedor();
    $consulta = $MU->listar_combo_proveedor();
    echo json_encode($consulta);
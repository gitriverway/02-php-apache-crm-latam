<?php
    require '../../model/modelo_categoria.php';
    $MU = new Modelo_Categoria();
    $consulta = $MU->listar_combo_categoria();
    echo json_encode($consulta);
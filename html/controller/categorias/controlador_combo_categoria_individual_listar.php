<?php
    require '../../model/modelo_categoria.php';

    // Individual = I
    // Empresarial = E
    $tipo = "I";

    $MU = new Modelo_Categoria();
    $consulta = $MU->listar_combo_categoria($tipo);
    echo json_encode($consulta);
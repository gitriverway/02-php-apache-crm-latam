<?php
    require '../../model/modelo_categoria.php';
    
    // Individual = I
    // Empresarial = E
    $tipo = "E";

    $MU = new Modelo_Categoria();
    $consulta = $MU->listar_combo_categoria($tipo);
    echo json_encode($consulta);
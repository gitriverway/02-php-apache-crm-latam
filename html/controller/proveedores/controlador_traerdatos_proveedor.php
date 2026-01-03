<?php
    require '../../model/modelo_proveedor.php';
    
    $MU = new Modelo_Proveedor();
    $idProveedor = htmlspecialchars($_POST['idProveedor'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->TraerDatosProveedor($idProveedor);

    echo json_encode($consulta);
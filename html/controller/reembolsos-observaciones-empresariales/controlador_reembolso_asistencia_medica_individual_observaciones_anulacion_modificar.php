<?php
    require '../../model/modelo_reembolso_observacion_empresarial.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');
    $lista_observaciones_anulacion = $_POST['lista_observaciones_anulacion'];

    $MU = new Modelo_Reembolso_Observacion_Empresarial();
    $consulta = $MU->Modificar_Observaciones_Anulacion_Reembolso($idReembolso,$lista_observaciones_anulacion,$fechaActual,$fechaActual1);


    echo json_encode($consulta);
<?php
    require '../../model/modelo_credito_ambulatorio_observacion.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');
    $lista_observaciones_anulacion = $_POST['lista_observaciones_anulacion'];

    $MU = new Modelo_Credito_Ambulatorio_Observacion();
    $consulta = $MU->Modificar_Observaciones_Anulacion_Credito_Ambulatorio($idCreditoAmbulatorio,$lista_observaciones_anulacion,$fechaActual,$fechaActual1);


    echo json_encode($consulta);
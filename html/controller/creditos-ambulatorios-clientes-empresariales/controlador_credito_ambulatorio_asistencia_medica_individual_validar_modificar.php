<?php
    require '../../extensiones/PHPMailer/src/Exception.php';
    require '../../extensiones/PHPMailer/src/PHPMailer.php';
    require '../../extensiones/PHPMailer/src/SMTP.php';
    require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';
    require 'controlador_credito_ambulatorio_enviar_correo_notificacion_documentos_faltantes_cliente_empresarial.php';
    require 'controlador_credito_ambulatorio_enviar_correo_aseguradora_empresarial.php';


    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');
    $listaValidarDatosCreditoAmbulatorio = $_POST['listaValidarDatosCreditoAmbulatorio'];
    $fecha_seguimiento_validar = htmlspecialchars($_POST['fecha_seguimiento_validar'],ENT_QUOTES,'UTF-8');
    $contar_validar = htmlspecialchars($_POST['contar_validar'],ENT_QUOTES,'UTF-8');
    $listaObservacionesDatosCreditoAmbulatorio = $_POST['listaObservacionesDatosCreditoAmbulatorio'];

    $MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();
    $consulta = $MU->Modificar_Credito_Ambulatorio_Validar($idCreditoAmbulatorio,$listaValidarDatosCreditoAmbulatorio,$listaObservacionesDatosCreditoAmbulatorio,$fecha_seguimiento_validar,$contar_validar,$fechaActual,$fechaActual1);

    if ($contar_validar > 0) {
        $MC = new Envio_correo_notificacion_documentos_faltantes_credito_ambulatorio_empresarial();
        $consulta1 = $MC->realizar_envio_correo_notificacion_documentos_faltantes_credito_ambulatorio_empresarial($idCreditoAmbulatorio,$idContrato);
    }else {
        $MC1 = new Envio_correo_aseguradora_con_documentos_credito_ambulatorio_empresarial();
        $consulta2 = $MC1->realizar_envio_correo_aseguradora_con_documentos_credito_ambulatorio_empresarial($idCreditoAmbulatorio,$idContrato);
    }

    echo json_encode($consulta);
<?php
    require '../../extensiones/PHPMailer/src/Exception.php';
    require '../../extensiones/PHPMailer/src/PHPMailer.php';
    require '../../extensiones/PHPMailer/src/SMTP.php';
    require '../../model/modelo_credito_ambulatorio_cliente.php';
    require '../../model/modelo_credito_ambulatorio_cliente_documento.php';
    require 'controlador_credito_ambulatorio_enviar_correo_documentos_seguimiento_aseguradora.php';

    session_start();

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');
    $fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'],ENT_QUOTES,'UTF-8');
    $listaObservacionesDocumentoSeguimientosCreditoAmbulatorio = $_POST['listaObservacionesDocumentoSeguimientosCreditoAmbulatorio'];

    $MU = new Modelo_Credito_Ambulatorio_Cliente();
    $consulta = $MU->Modificar_Envio_Credito_Ambulatorio_Seguimiento($idCreditoAmbulatorio,$fecha_seguimiento,$listaObservacionesDocumentoSeguimientosCreditoAmbulatorio,$fechaActual,$fechaActual1);

    /*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL PEDIDO CREDITO AMBULATORIOS
    =============================================*/

    $directorio1 = "view/ambulatorios/".$idCreditoAmbulatorio;

    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $nombreArchivo = "DOCUMENTO_SEGUIMIENTO";
    $rutaArchivo = $directorio1."/DOCUMENTO_SEGUIMIENTO".$ano.$mes.$dia.$hora.$minuto.$segundo.".".$_POST["extension"];
            
    $archivo = $_FILES["documento"]["tmp_name"];
    $dato = move_uploaded_file($archivo,"../../".$rutaArchivo);

    $MCCD = new Modelo_Credito_Ambulatorio_Cliente_Documento();
    $consulta2 = $MCCD->Registrar_credito_ambulatorio_cliente_documento($idCreditoAmbulatorio,$nombreArchivo,$rutaArchivo,$fechaActual);

    $MU1 = new Envio_correo_documentos_seguimiento_credito_ambulatorio();
    $consulta1 = $MU1->realizar_envio_correo_documentos_seguimiento_credito_ambulatorio($idCreditoAmbulatorio,$idContrato);

    echo json_encode($consulta2);
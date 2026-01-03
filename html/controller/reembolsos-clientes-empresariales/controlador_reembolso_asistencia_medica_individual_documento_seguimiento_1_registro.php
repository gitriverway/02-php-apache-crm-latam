<?php
    require '../../extensiones/PHPMailer/src/Exception.php';
    require '../../extensiones/PHPMailer/src/PHPMailer.php';
    require '../../extensiones/PHPMailer/src/SMTP.php';
    require '../../model/modelo_reembolso_cliente_empresarial.php';
    require '../../model/modelo_reembolso_cliente_documento_empresarial.php';
    require 'controlador_reembolso_enviar_correo_documentos_seguimiento_aseguradora_empresarial_1.php';

    session_start();

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');
    $fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'],ENT_QUOTES,'UTF-8');
    $listaObservacionesDocumentoSeguimientosReembolso = $_POST['listaObservacionesDocumentoSeguimientosReembolso'];

    $MU = new Modelo_Reembolso_Cliente_Empresarial();
    $consulta = $MU->Modificar_Envio_Reembolso_Seguimiento($idReembolso,$fecha_seguimiento,$listaObservacionesDocumentoSeguimientosReembolso,$fechaActual,$fechaActual1);

    /*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL REEMBOLSOS
    =============================================*/

    $directorio1 = "view/reembolsos/".$idReembolso;

    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $nombreArchivo = "DOCUMENTO_SEGUIMIENTO_1";
    $rutaArchivo = $directorio1."/DOCUMENTO_SEGUIMIENTO_1".$ano.$mes.$dia.$hora.$minuto.$segundo.".".$_POST["extension"];
            
    $archivo = $_FILES["documento"]["tmp_name"];
    $dato = move_uploaded_file($archivo,"../../".$rutaArchivo);

    $MCCD = new Modelo_Reembolso_Cliente_Documento_Empresarial();
    $consulta2 = $MCCD->Registrar_reembolso_cliente_documento($idReembolso,$nombreArchivo,$rutaArchivo,$fechaActual);

    $MU1 = new Envio_correo_documentos_seguimiento_reembolso_empresarial_1();
    $consulta1 = $MU1->realizar_envio_correo_documentos_seguimiento_reembolso_empresarial_1($idReembolso,$idContrato);

    echo json_encode($consulta2);
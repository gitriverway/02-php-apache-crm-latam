<?php
    require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';
    require '../../model/modelo_credito_ambulatorio_cliente_documento_empresarial.php';
    require 'controlador_credito_ambulatorio_enviar_correo_notificacion_documentos_faltantes_seguimiento_cliente_empresarial.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');
    $listaDocumentosSolicitadosAseguradora = $_POST['listaDocumentosSolicitadosAseguradora'];
    $enviar_mail = htmlspecialchars($_POST['enviar_mail'],ENT_QUOTES,'UTF-8');
    $fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'],ENT_QUOTES,'UTF-8');
    $listaObservacionesSeguimientosCreditoAmbulatorio = $_POST['listaObservacionesSeguimientosCreditoAmbulatorio'];
    $estado_caducado = $_POST['estado_caducado'];

    $MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();
    $consulta = $MU->Modificar_Credito_Ambulatorio_Seguimiento($idCreditoAmbulatorio,$listaDocumentosSolicitadosAseguradora,$listaObservacionesSeguimientosCreditoAmbulatorio,$fecha_seguimiento,$fechaActual,$fechaActual1,$estado_caducado);

    /*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL REEMBOLSOS
    =============================================*/
    if (isset($_FILES["documento"])){
        $directorio1 = "view/ambulatorios/".$idCreditoAmbulatorio;

        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');
        $hora = date('H');
        $minuto = date('i');
        $segundo = date('s');

        $nombreArchivo = "DOCUMENTO_PEDIDO_ASEGURADORA";
        $rutaArchivo = $directorio1."/DOCUMENTO_PEDIDO_ASEGURADORA".$ano.$mes.$dia.$hora.$minuto.$segundo.".".$_POST["extension"];
                
        $archivo = $_FILES["documento"]["tmp_name"];
        $dato = move_uploaded_file($archivo,"../../".$rutaArchivo);

        $MOCD = new Modelo_Credito_Ambulatorio_Cliente_Documento_Empresarial();
        $consulta2 = $MOCD->Registrar_credito_ambulatorio_cliente_documento($idCreditoAmbulatorio,$nombreArchivo,$rutaArchivo,$fechaActual);

    }

    if ($estado_caducado == "SI") {
        # code...
    }else {
        if ($enviar_mail == "SI") {
            $MC = new Envio_correo_notificacion_documentos_faltantes_seguimiento_credito_ambulatorio_empresarial();
            $consulta1 = $MC->realizar_envio_correo_notificacion_documentos_faltantes_seguimiento_credito_ambulatorio_empresarial($idCreditoAmbulatorio,$idContrato);
        }
    }

    echo json_encode($consulta);
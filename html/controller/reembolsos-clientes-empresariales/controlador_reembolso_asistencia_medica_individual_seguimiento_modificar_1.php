<?php
    require '../../model/modelo_reembolso_cliente_empresarial.php';
    require '../../model/modelo_reembolso_cliente_documento.php';
    require 'controlador_reembolso_enviar_correo_notificacion_documentos_faltantes_seguimiento_cliente_empresarial_1.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');
    $idContrato = htmlspecialchars($_POST['idContrato'],ENT_QUOTES,'UTF-8');
    $listaDocumentosSolicitadosAseguradora = $_POST['listaDocumentosSolicitadosAseguradora'];
    $enviar_mail = htmlspecialchars($_POST['enviar_mail'],ENT_QUOTES,'UTF-8');
    $fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'],ENT_QUOTES,'UTF-8');
    $listaObservacionesSeguimientosReembolso = $_POST['listaObservacionesSeguimientosReembolso'];
    $estado_caducado = $_POST['estado_caducado'];

    $MU = new Modelo_Reembolso_Cliente_Empresarial();
    $consulta = $MU->Modificar_Reembolso_Seguimiento_1($idReembolso,$listaDocumentosSolicitadosAseguradora,$listaObservacionesSeguimientosReembolso,$fecha_seguimiento,$fechaActual,$fechaActual1,$estado_caducado);

    /*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL REEMBOLSOS
    =============================================*/

    if (isset($_FILES["documento"])){

        $directorio1 = "view/reembolsos/".$idReembolso;

        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');
        $hora = date('H');
        $minuto = date('i');
        $segundo = date('s');

        $nombreArchivo = "DOCUMENTO_PEDIDO_ASEGURADORA_1";
        $rutaArchivo = $directorio1."/DOCUMENTO_PEDIDO_ASEGURADORA_1".$ano.$mes.$dia.$hora.$minuto.$segundo.".".$_POST["extension"];
                
        $archivo = $_FILES["documento"]["tmp_name"];
        $dato = move_uploaded_file($archivo,"../../".$rutaArchivo);

        $MCCD = new Modelo_Reembolso_Cliente_Documento();
        $consulta2 = $MCCD->Registrar_reembolso_cliente_documento($idReembolso,$nombreArchivo,$rutaArchivo,$fechaActual);
    }

    if ($estado_caducado == "SI") {
        # code...
    }else {
        if ($enviar_mail == "SI") {
            $MC = new Envio_correo_notificacion_documentos_faltantes_seguimiento_reembolso_empresarial_1();
            $consulta1 = $MC->realizar_envio_correo_notificacion_documentos_faltantes_seguimiento_reembolso_empresarial_1($idReembolso,$idContrato);
        }
    }
    

    echo json_encode($consulta);
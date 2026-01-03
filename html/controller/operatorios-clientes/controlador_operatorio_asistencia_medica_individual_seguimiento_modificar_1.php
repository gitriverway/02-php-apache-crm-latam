<?php
require '../../model/modelo_operatorio_cliente.php';
require '../../model/modelo_operatorio_cliente_documento.php';
require 'controlador_operatorio_enviar_correo_notificacion_documentos_faltantes_seguimiento_cliente_1.php';

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idOperatorio = htmlspecialchars($_POST['idOperatorio'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$listaDocumentosSolicitadosAseguradora = $_POST['listaDocumentosSolicitadosAseguradora'];
$enviar_mail = htmlspecialchars($_POST['enviar_mail'], ENT_QUOTES, 'UTF-8');
$fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'], ENT_QUOTES, 'UTF-8');
$listaObservacionesSeguimientosOperatorio = $_POST['listaObservacionesSeguimientosOperatorio'];
$estado_caducado = $_POST['estado_caducado'];

$MU = new Modelo_Operatorio_Cliente();
$consulta = $MU->Modificar_Operatorio_Seguimiento_1($idOperatorio, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosOperatorio, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado);

/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL REEMBOLSOS
    =============================================*/
if (isset($_FILES["documento"])) {
    $directorio1 = "view/operatorios/" . $idOperatorio;

    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $nombreArchivo = "DOCUMENTO_PEDIDO_ASEGURADORA_1";
    $rutaArchivo = $directorio1 . "/DOCUMENTO_PEDIDO_ASEGURADORA_1" . $ano . $mes . $dia . $hora . $minuto . $segundo . "." . $_POST["extension"];

    $archivo = $_FILES["documento"]["tmp_name"];
    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

    $MOCD = new Modelo_Operatorio_Cliente_Documento();
    $consulta2 = $MOCD->Registrar_operatorio_cliente_documento($idOperatorio, $nombreArchivo, $rutaArchivo, $fechaActual);
}

if ($estado_caducado == "SI") {
    # code...
} else {
    if ($enviar_mail == "SI") {
        $CEDFO = new Envio_correo_notificacion_documentos_faltantes_seguimiento_operatorio_1();
        $consulta1 = $CEDFO->realizar_envio_correo_notificacion_documentos_faltantes_seguimiento_operatorio_1($idOperatorio, $idContrato);
    }
}

echo json_encode($consulta);
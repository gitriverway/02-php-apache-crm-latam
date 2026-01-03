<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';
require '../../model/modelo_operatorio_cliente.php';
require '../../model/modelo_operatorio_cliente_documento.php';
require 'controlador_operatorio_enviar_correo_documentos_seguimiento_aseguradora_1.php';

session_start();

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idOperatorio = htmlspecialchars($_POST['idOperatorio'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'], ENT_QUOTES, 'UTF-8');
$listaObservacionesDocumentoSeguimientosOperatorio = $_POST['listaObservacionesDocumentoSeguimientosOperatorio'];

$MU = new Modelo_Operatorio_Cliente();
$consulta = $MU->Modificar_Envio_Operatorio_Seguimiento($idOperatorio, $fecha_seguimiento, $listaObservacionesDocumentoSeguimientosOperatorio, $fechaActual, $fechaActual1);

/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL PEDIDO OPERATORIO
    =============================================*/

$directorio1 = "view/operatorios/" . $idOperatorio;

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$minuto = date('i');
$segundo = date('s');

$nombreArchivo = "DOCUMENTO_SEGUIMIENTO_1";
$rutaArchivo = $directorio1 . "/DOCUMENTO_SEGUIMIENTO_1" . $ano . $mes . $dia . $hora . $minuto . $segundo . "." . $_POST["extension"];

$archivo = $_FILES["documento"]["tmp_name"];
$dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

$MCCD = new Modelo_Operatorio_Cliente_Documento();
$consulta2 = $MCCD->Registrar_operatorio_cliente_documento($idOperatorio, $nombreArchivo, $rutaArchivo, $fechaActual);

$MU1 = new Envio_correo_documentos_seguimiento_operatorio_1();
$consulta1 = $MU1->realizar_envio_correo_documentos_seguimiento_operatorio_1($idOperatorio, $idContrato);

echo json_encode($consulta2);

<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';
require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';
require '../../model/modelo_credito_ambulatorio_cliente_documento_empresarial.php';
require 'controlador_credito_ambulatorio_enviar_correo_autorizacion_cliente_empresarial.php';

session_start();

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$listaObservacionesAutorizacionCreditoAmbulatorio = $_POST['listaObservacionesAutorizacionCreditoAmbulatorio'];

$MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();

$consulta = $MU->Modificar_Credito_Ambulatorio_Autorizacion($idCreditoAmbulatorio, $listaObservacionesAutorizacionCreditoAmbulatorio, $fechaActual, $fechaActual1);

/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL OPERATORIO
    =============================================*/

$directorio1 = "view/ambulatorios/" . $idCreditoAmbulatorio;

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$minuto = date('i');
$segundo = date('s');

$nombreArchivo = "DOCUMENTO_AUTORIZACION";
$rutaArchivo = $directorio1 . "/DOCUMENTO_AUTORIZACION" . $ano . $mes . $dia . $hora . $minuto . $segundo . "." . $_POST["extension"];

$archivo = $_FILES["documento"]["tmp_name"];
$dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

$MCCD = new Modelo_Credito_Ambulatorio_Cliente_Documento_Empresarial();
$consulta1 = $MCCD->Registrar_credito_ambulatorio_cliente_documento($idCreditoAmbulatorio, $nombreArchivo, $rutaArchivo, $fechaActual);

$ECL = new Envio_correo_notificacion_autorizacion_credito_ambulatorio_empresarial();
$consulta2 = $ECL->realizar_envio_correo_notificacion_autorizacion_credito_ambulatorio_empresarial($idCreditoAmbulatorio, $idContrato);

echo json_encode($consulta);

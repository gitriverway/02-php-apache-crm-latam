<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';
require '../../model/modelo_reembolso_cliente.php';
require '../../model/modelo_reembolso_cliente_documento.php';
require 'controlador_reembolso_enviar_correo_liquidacion_cliente.php';

session_start();

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idReembolso = htmlspecialchars($_POST['idReembolso'], ENT_QUOTES, 'UTF-8');
$idBayer = htmlspecialchars($_POST['idBayer'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$lista_dependientes = $_POST['lista_dependientes'];
$deducible_contrato = htmlspecialchars($_POST['deducible_contrato'], ENT_QUOTES, 'UTF-8');
$valor_cobrado = htmlspecialchars($_POST['valor_cobrado'], ENT_QUOTES, 'UTF-8');
$saldo_deducible = htmlspecialchars($_POST['saldo_deducible'], ENT_QUOTES, 'UTF-8');
$valor_presentado = htmlspecialchars($_POST['valor_presentado'], ENT_QUOTES, 'UTF-8');
$valor_no_cubierto = htmlspecialchars($_POST['valor_no_cubierto'], ENT_QUOTES, 'UTF-8');
$valor_copago = htmlspecialchars($_POST['valor_copago'], ENT_QUOTES, 'UTF-8');
$valor_reembolsado = htmlspecialchars($_POST['valor_reembolsado'], ENT_QUOTES, 'UTF-8');
$listaObservacionesLiquidacionReembolso = $_POST['listaObservacionesLiquidacionReembolso'];

$MU = new Modelo_Reembolso_Cliente();

$consulta = $MU->Modificar_Reembolso_Liquidacion($idReembolso, $idBayer, $idContrato, $lista_dependientes, $deducible_contrato, $valor_cobrado, $saldo_deducible, $valor_presentado, $valor_no_cubierto, $valor_copago, $valor_reembolsado, $fechaActual, $listaObservacionesLiquidacionReembolso, $fechaActual1);

/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL REEMBOLSOS
    =============================================*/

$directorio1 = "view/reembolsos/" . $idReembolso;

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$minuto = date('i');
$segundo = date('s');

$nombreArchivo = "DOCUMENTO_LIQUIDACION";
$rutaArchivo = $directorio1 . "/DOCUMENTO_LIQUIDACION" . $ano . $mes . $dia . $hora . $minuto . $segundo . "." . $_POST["extension"];

$archivo = $_FILES["documento"]["tmp_name"];
$dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

$MCCD = new Modelo_Reembolso_Cliente_Documento();
$consulta1 = $MCCD->Registrar_reembolso_cliente_documento($idReembolso, $nombreArchivo, $rutaArchivo, $fechaActual);

$ECL = new Envio_correo_notificacion_liquidacion_reembolso();
$consulta2 = $ECL->realizar_envio_correo_notificacion_liquidacion_reembolso($idReembolso, $idContrato);

echo json_encode($consulta);
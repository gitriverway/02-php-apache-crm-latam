<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';

require '../../model/modelo_reembolso_cliente.php';
require 'controlador_reembolso_enviar_correo_notificacion_documentos_faltantes_cliente.php';
require 'controlador_reembolso_enviar_correo_aseguradora.php';



date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idReembolso = htmlspecialchars($_POST['idReembolso'], ENT_QUOTES, 'UTF-8');
$idBayer = htmlspecialchars($_POST['idBayer'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$listaValidarDatosReembolso = $_POST['listaValidarDatosReembolso'];
$fecha_seguimiento_validar = htmlspecialchars($_POST['fecha_seguimiento_validar'], ENT_QUOTES, 'UTF-8');
$contar_validar = htmlspecialchars($_POST['contar_validar'], ENT_QUOTES, 'UTF-8');
$listaObservacionesDatosReembolso = $_POST['listaObservacionesDatosReembolso'];

$MU = new Modelo_Reembolso_Cliente();
$consulta = $MU->Modificar_Reembolso_Validar($idReembolso, $listaValidarDatosReembolso, $listaObservacionesDatosReembolso, $fecha_seguimiento_validar, $contar_validar, $fechaActual, $fechaActual1);

if ($contar_validar > 0) {
    $MC = new Envio_correo_notificacion_documentos_faltantes_reembolso();
    $consulta1 = $MC->realizar_envio_correo_notificacion_documentos_faltantes_reembolso($idReembolso, $idContrato);
} else {
    $MC1 = new Envio_correo_aseguradora_con_documentos_reembolso();
    $consulta2 = $MC1->realizar_envio_correo_aseguradora_con_documentos_reembolso($idReembolso, $idContrato);
}

echo json_encode($consulta);

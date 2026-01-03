<?php
require '../../model/modelo_reembolso_cliente.php';
require '../../model/modelo_reembolso_observacion.php';
require 'controlador_reembolso_enviar_correo_notificacion_observaciones.php';

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idReembolso = htmlspecialchars($_POST['idReembolso'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'], ENT_QUOTES, 'UTF-8');
$lista_observaciones_adicionales = $_POST['lista_observaciones_adicionales'];

$MU = new Modelo_Reembolso_Observacion();
$consulta = $MU->Modificar_Observaciones_Adicionales_Seguimiento_Reembolso($idReembolso, $lista_observaciones_adicionales, $fecha_seguimiento, $fechaActual, $fechaActual1);

$MC = new Envio_correo_notificacion_observaciones_reembolsos();
$consulta1 = $MC->realizar_envio_correo_notificacion_observaciones_reembolsos($idReembolso, $idContrato);

echo json_encode($consulta);

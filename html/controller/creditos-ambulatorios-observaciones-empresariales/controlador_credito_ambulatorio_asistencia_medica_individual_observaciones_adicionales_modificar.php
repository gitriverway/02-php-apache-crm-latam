<?php
require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';
require '../../model/modelo_credito_ambulatorio_observacion_empresarial.php';
require 'controlador_credito_ambulatorio_enviar_correo_notificacion_observaciones_empresarial.php';

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'], ENT_QUOTES, 'UTF-8');
$lista_observaciones_adicionales = $_POST['lista_observaciones_adicionales'];

$MU = new Modelo_Credito_Ambulatorio_Observacion_Empresarial();
$consulta = $MU->Modificar_Observaciones_Adicionales_Seguimiento_Credito_Ambulatorio($idCreditoAmbulatorio, $lista_observaciones_adicionales, $fecha_seguimiento, $fechaActual, $fechaActual1);

$MO = new Envio_correo_notificacion_observaciones_credito_ambulatorio_empresarial();
$consulta1 = $MO->realizar_envio_correo_notificacion_observaciones_credito_ambulatorio_empresarial($idCreditoAmbulatorio, $idContrato);


echo json_encode($consulta);
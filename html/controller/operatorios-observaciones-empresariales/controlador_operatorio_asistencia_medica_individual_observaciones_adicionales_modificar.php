<?php
require '../../model/modelo_operatorio_cliente_empresarial.php';
require '../../model/modelo_operatorio_observacion_empresarial.php';
require 'controlador_operatorio_enviar_correo_observaciones.php';

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idOperatorio = htmlspecialchars($_POST['idOperatorio'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'], ENT_QUOTES, 'UTF-8');
$lista_observaciones_adicionales = $_POST['lista_observaciones_adicionales'];

$MU = new Modelo_Operatorio_Observacion_Empresarial();
$consulta = $MU->Modificar_Observaciones_Adicionales_Seguimiento_Operatorio($idOperatorio, $lista_observaciones_adicionales, $fecha_seguimiento, $fechaActual, $fechaActual1);

$MO = new Envio_correo_observaciones_operatorio_empresarial();
$consulta1 = $MO->realizar_envio_correo_observaciones_operatorio_empresarial($idOperatorio, $idContrato);


echo json_encode($consulta);

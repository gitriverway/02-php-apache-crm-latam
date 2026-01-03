<?php
require '../../model/modelo_usuario.php';
require '../../model/modelo_cliente.php';

date_default_timezone_set('America/Guayaquil');

$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha . ' ' . $hora;

$idCliente = htmlspecialchars($_POST['idCliente'], ENT_QUOTES, 'UTF-8');
$cedula = htmlspecialchars($_POST['cedula'], ENT_QUOTES, 'UTF-8');
$contra = password_hash($_POST['cedula'], PASSWORD_DEFAULT, ['cost' => 12]);
$fecha_actual = date('Y-m-d'); // Fecha actual
$fecha_caduca = date('Y-m-d', strtotime($fecha_actual . ' +90 days'));

$MU = new Modelo_Usuario();
$consulta = $MU->Modificar_Password_Cliente($idCliente, $cedula, $contra, $fechaActual, $fecha_caduca);

echo json_encode($consulta);

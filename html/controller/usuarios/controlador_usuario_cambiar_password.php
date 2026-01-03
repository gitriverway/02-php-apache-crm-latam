<?php
require '../../model/modelo_usuario.php';

date_default_timezone_set('America/Guayaquil');

$MU = new Modelo_Usuario();
$idUsuario = $_POST['usuario_id'];
$contra = password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost' => 12]);
$fecha_actual = date('Y-m-d'); // Fecha actual
$fecha_caduca = date('Y-m-d', strtotime($fecha_actual . ' +90 days'));

$consulta = $MU->Update_Password_Usuario($idUsuario, $contra, $fecha_caduca);

echo json_encode($consulta);

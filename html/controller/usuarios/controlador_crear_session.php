<?php
require '../../model/modelo_usuario.php';

$IDUSUARIO = $_POST['idusuario'];
$USER = $_POST['user'];
$EMPLEADO = $_POST['empleado'];
$ROL = $_POST['rol'];
$FECHA_REGISTRO = $_POST['fecha_registro'];

$MU = new Modelo_Usuario();
$usuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');

/*=============================================
REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
=============================================*/

date_default_timezone_set('America/Guayaquil');

$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha.' '.$hora;

$consulta = $MU->Registrar_Usuario_Ultimo_Login($IDUSUARIO,$fechaActual);

session_start();
$_SESSION["S_SESION"] = "ok";
$_SESSION['S_IDUSUARIO']=$IDUSUARIO;
$_SESSION['S_USER']=$USER;
$_SESSION['S_EMPLEADO']=$EMPLEADO;
$_SESSION['S_ROL']=$ROL;
$_SESSION['S_FECHA_REGISTRO']=$FECHA_REGISTRO;
$_SESSION["S_ULTIMOACCESO"]= $fechaActual;

/*=============================================
INICIALIZAR IDIOMA POR DEFECTO (INGLÉS)
=============================================*/
if (!isset($_SESSION['S_IDIOMA'])) {
    $_SESSION['S_IDIOMA'] = 'en';
}

echo $_SESSION["S_SESION"];
<?php
require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';
require '../../model/modelo_credito_ambulatorio_cliente_documento_empresarial.php';

session_start();

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idBayer = htmlspecialchars($_POST['idBayer'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$listaDatosCreditoAmbulatorio = $_POST['listaDatosCreditoAmbulatorio'];
$idUsuario = $_SESSION['S_IDUSUARIO'];
$idCreditoAmbulatorio = "";

$MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();

$consulta = $MU->Registrar_Credito_Ambulatorio($idBayer, $idContrato, $listaDatosCreditoAmbulatorio, $fechaActual, $fechaActual1);

for ($i = 0; $i < count($consulta); $i++) {
    $idCreditoAmbulatorio = $consulta[0][$i];
}

/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL OPERATORIOS
    =============================================*/

$directorio_raiz = "../../view/ambulatorios";

if (!is_dir($directorio_raiz)) {
    mkdir($directorio_raiz, 0755);
}

$directorio = "../../view/ambulatorios/" . $idCreditoAmbulatorio;
$directorio1 = "view/ambulatorios/" . $idCreditoAmbulatorio;

mkdir($directorio, 0755);

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$minuto = date('i');
$segundo = date('s');

$nombreArchivo = "DOCUMENTO";
$rutaArchivo = $directorio1 . "/DOCUMENTO" . $ano . $mes . $dia . $hora . $minuto . $segundo . "." . $_POST["extension"];

$archivo = $_FILES["documento"]["tmp_name"];
$dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

$MCCD = new Modelo_Credito_Ambulatorio_Cliente_Documento_Empresarial();
$consulta1 = $MCCD->Registrar_credito_ambulatorio_cliente_documento($idCreditoAmbulatorio, $nombreArchivo, $rutaArchivo, $fechaActual);

echo json_encode($consulta);

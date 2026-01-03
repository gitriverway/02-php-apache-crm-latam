<?php
require '../../model/modelo_operatorio_cliente.php';
require '../../model/modelo_operatorio_cliente_documento.php';

session_start();

date_default_timezone_set('America/Guayaquil');

$fechaActual = date('Y-m-d') . ' ' . date('H:i:s');
$fechaActual1 = date('Y-m-d');

$idBayer = htmlspecialchars($_POST['idBayer'], ENT_QUOTES, 'UTF-8');
$idContrato = htmlspecialchars($_POST['idContrato'], ENT_QUOTES, 'UTF-8');
$listaDatosOperatorio = $_POST['listaDatosOperatorio'];
$idUsuario = $_SESSION['S_IDUSUARIO'];
$idOperatorio = "";

$MU = new Modelo_Operatorio_Cliente();

$consulta = $MU->Registrar_Operatorio($idBayer, $idContrato, $listaDatosOperatorio, $fechaActual, $fechaActual1);

for ($i = 0; $i < count($consulta); $i++) {
    $idOperatorio = $consulta[0][$i];
}

/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL OPERATORIOS
    =============================================*/

$directorio_raiz = "../../view/operatorios";

if (!is_dir($directorio_raiz)) {
    mkdir($directorio_raiz, 0755);
}

$directorio = "../../view/operatorios/" . $idOperatorio;
$directorio1 = "view/operatorios/" . $idOperatorio;

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

$MCCD = new Modelo_Operatorio_Cliente_Documento();
$consulta1 = $MCCD->Registrar_operatorio_cliente_documento($idOperatorio, $nombreArchivo, $rutaArchivo, $fechaActual);

echo json_encode($consulta);

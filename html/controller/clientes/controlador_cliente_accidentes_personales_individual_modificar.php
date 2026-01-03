<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';
require 'controlador_cliente_enviar_correo_acceso.php';
require '../../model/modelo_bayer_persona.php';
require '../../model/modelo_bayer_persona_dependiente.php';
require '../../model/modelo_cliente.php';
require '../../model/modelo_contrato_cliente_documento.php';

session_start();

date_default_timezone_set('America/Guayaquil');

$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha . ' ' . $hora;

$idBayer = htmlspecialchars($_POST['idBayer'], ENT_QUOTES, 'UTF-8');
$origen = htmlspecialchars($_POST['origen'], ENT_QUOTES, 'UTF-8');
$categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'UTF-8');
$proveedor = htmlspecialchars($_POST['proveedor'], ENT_QUOTES, 'UTF-8');
$idProducto = htmlspecialchars($_POST['idProducto'], ENT_QUOTES, 'UTF-8');
$idCliente = htmlspecialchars($_POST['idCliente'], ENT_QUOTES, 'UTF-8');
$cedula = htmlspecialchars($_POST['cedula'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento'], ENT_QUOTES, 'UTF-8');
$edad_nacimiento = htmlspecialchars($_POST['edad_nacimiento'], ENT_QUOTES, 'UTF-8');
$genero = htmlspecialchars($_POST['genero'], ENT_QUOTES, 'UTF-8');
$estado_civil = htmlspecialchars($_POST['estado_civil'], ENT_QUOTES, 'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
$telefono_opcional = htmlspecialchars($_POST['telefono_opcional'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$email_opcional = htmlspecialchars($_POST['email_opcional'], ENT_QUOTES, 'UTF-8');
$provincia = htmlspecialchars($_POST['provincia'], ENT_QUOTES, 'UTF-8');
$ciudad = htmlspecialchars($_POST['ciudad'], ENT_QUOTES, 'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
$ocupacion = htmlspecialchars($_POST['ocupacion'], ENT_QUOTES, 'UTF-8');
$valor_ingreso = htmlspecialchars($_POST['valor_ingreso'], ENT_QUOTES, 'UTF-8');
$valor_asegurado = htmlspecialchars($_POST['valor_asegurado'], ENT_QUOTES, 'UTF-8');
$prima_neta = htmlspecialchars($_POST['prima_neta'], ENT_QUOTES, 'UTF-8');
$prima_comisionable = htmlspecialchars($_POST['prima_comisionable'], ENT_QUOTES, 'UTF-8');
$prima_total = htmlspecialchars($_POST['prima_total'], ENT_QUOTES, 'UTF-8');
$tipo_pago = htmlspecialchars($_POST['tipo_pago'], ENT_QUOTES, 'UTF-8');
$forma_pago = htmlspecialchars($_POST['forma_pago'], ENT_QUOTES, 'UTF-8');
$estado_bayer = htmlspecialchars($_POST['estado_bayer'], ENT_QUOTES, 'UTF-8');
$listaDependientesContrato = $_POST['listaDependientesContrato'];
$listaContratos = $_POST['listaContratos'];
$listaObservaciones = $_POST['listaObservaciones'];
$idUsuario = $_SESSION['S_IDUSUARIO'];
$contra = password_hash($_POST['cedula'], PASSWORD_DEFAULT, ['cost' => 12]);
$fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'], ENT_QUOTES, 'UTF-8');
$cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
$idEmpleado = htmlspecialchars($_POST['idEmpleado'], ENT_QUOTES, 'UTF-8');

/**==================================================================================================
 * CREAMOS UN NUEVO DIRECTORIO POR LA FECHA Y CLIENTE, DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL CONTRATO
     ===================================================================================================*/
if ($cantidad > 0) {

    $directorio_raiz = "../../view/contratos";

    if (!is_dir($directorio_raiz)) {
        mkdir($directorio_raiz, 0755);
    }

    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $directorio2 = "../../view/contratos/" . $idBayer;

    if (!is_dir($directorio2)) {
        mkdir($directorio2, 0755);
    }

    $carpetaDocumento = $ano . $mes . $dia . $hora . $minuto . $cedula;
    $directorio = "../../view/contratos/" . $idBayer . "/" . $carpetaDocumento;
    $directorio1 = "view/contratos/" . $idBayer . "/" . $carpetaDocumento;

    if (!is_dir($directorio)) {
        mkdir($directorio, 0755);
    }

    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_FILES["documento_" . $i])) {

            $ano1 = date('Y');
            $mes1 = date('m');
            $dia1 = date('d');
            $hora1 = date('H');
            $minuto1 = date('i');
            $segundo1 = date('s');

            switch ($i) {
                case '1':
                    $nombreArchivo = "CÉDULA";
                    $rutaArchivo = $directorio1 . "/CEDULA" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);
                    break;
                case '2':
                    $nombreArchivo = "RUC";
                    $rutaArchivo = $directorio1 . "/RUC" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

                    break;
                case '3':
                    $nombreArchivo = "COTIZACIÓN";
                    $rutaArchivo = $directorio1 . "/COTIZACION" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);
                    break;
                case '4':
                    $nombreArchivo = "CONTRATO";
                    $rutaArchivo = $directorio1 . "/CONTRATO" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);

                    break;
                case '5':
                    $nombreArchivo = "FACTURA";
                    $rutaArchivo = $directorio1 . "/FACTURA" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);
                    break;
                case '6':
                    $nombreArchivo = "LISTA PERSONAL";
                    $rutaArchivo = $directorio1 . "/LISTA-PERSONAL" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);
                    break;
                case '7':
                    $nombreArchivo = "SOLICITUD AFILIACIÓN";
                    $rutaArchivo = $directorio1 . "/SOLICITUD-AFILIACION" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);
                    break;
                case '8':
                    $nombreArchivo = "CARTA NOMBRAMIENTO";
                    $rutaArchivo = $directorio1 . "/CARTA-NOMBRAMIENTO" . $ano1 . $mes1 . $dia1 . $hora1 . $minuto1 . $segundo1 . $cedula . "." . $_POST["extension_" . $i];
                    $archivo = $_FILES["documento_" . $i]["tmp_name"];
                    $dato = move_uploaded_file($archivo, "../../" . $rutaArchivo);
                    break;
                default:
                    # code...
                    break;
            }

            $MCCD = new Modelo_Contrato_Cliente_Documento();
            $consulta1 = $MCCD->Registrar_contrato_cliente_documento($idBayer, $nombreArchivo, $carpetaDocumento, $rutaArchivo, $fechaActual);
        }
    }
}

$MU = new Modelo_Bayer_Persona();

$consulta = $MU->Modificar_Cliente($idBayer, $origen, $categoria, $cedula, $nombre, $fecha_nacimiento, $genero, $telefono, $email, $provincia, $ciudad, $direccion, $ocupacion, $valor_ingreso, $valor_asegurado, $prima_total, $tipo_pago, $forma_pago, $idUsuario, $estado_bayer, $idProducto, $fechaActual, $proveedor, $contra, $fecha_seguimiento, $listaObservaciones, $idCliente, $prima_comisionable, $prima_neta, $telefono_opcional, $email_opcional, $idEmpleado, $estado_civil, $edad_nacimiento);

$lista = json_decode($listaDependientesContrato, true);
$lista1 = json_decode($listaContratos, true);
$contador_contrato = 0;

for ($i = 0; $i < count($lista); $i++) {

    $numero_activo = count($lista) - 1;
    if ($i < $numero_activo) {
        $estado_contrato = "CADUCADO";
    } else {
        $estado_contrato = "ACTIVO";
    }
    /**===========================
     * =====VALORES DEL CONTRATO
     ===========================*/
    $idDependientes =  $lista[$i]["id"];
    $listaFamiliares = $lista[$i]["lista_familiares"];
    $listaVehiculos = $lista[$i]["lista_vehiculos"];
    $idContrato = $lista1[$i]["id"];
    $contra_numero = $lista1[$i]["numero_contrato"];
    $fecha_inicio = $lista1[$i]["fecha_inicio_contrato"];
    $fecha_fin = $lista1[$i]["fecha_fin_contrato"];
    $estado_pago = $lista1[$i]["estado_pago"];

    if ($contra_numero == "" || $fecha_inicio == "" || $fecha_fin == "") {
        $contador_contrato++;
    }

    $MD = new Modelo_Bayer_Persona_Dependiente();

    $consultaMD = $MD->Modificar_Dependientes($idBayer, $idDependientes, $idContrato, $listaFamiliares, $listaVehiculos, $contra_numero, $fecha_inicio, $fecha_fin, $estado_pago, $fechaActual, $estado_contrato);
}

// if ($contador_contrato == 0) {
//     $ACE = new Envio_correo_notificacion_acceso();
//     $consulta2 = $ACE->realizar_envio_correo_notificacion_acceso($idCliente, $cedula, $estado_bayer);
// }

echo json_encode($consulta);
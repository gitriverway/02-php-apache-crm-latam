<?php
    require '../../extensiones/PHPMailer/src/Exception.php';
    require '../../extensiones/PHPMailer/src/PHPMailer.php';
    require '../../extensiones/PHPMailer/src/SMTP.php';
    require '../../model/modelo_bayer_persona_empresarial.php';
    require 'controlador_prospecto_enviar_correo_nuevo_contrato_accidentes_personales.php';

    session_start();

    date_default_timezone_set('America/Guayaquil');

    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $origen = htmlspecialchars($_POST['origen'],ENT_QUOTES,'UTF-8');
    $categoria = htmlspecialchars($_POST['categoria'],ENT_QUOTES,'UTF-8');
    $nueva_categoria  = htmlspecialchars($_POST['nuevo_categoria'],ENT_QUOTES,'UTF-8');
    $proveedor = htmlspecialchars($_POST['proveedor'],ENT_QUOTES,'UTF-8');
    $idProducto = htmlspecialchars($_POST['idProducto'],ENT_QUOTES,'UTF-8');
    $idCliente = htmlspecialchars($_POST['idCliente'],ENT_QUOTES,'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'],ENT_QUOTES,'UTF-8');
    $nombre_prospecto = htmlspecialchars($_POST['nombre_prospecto'],ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
    $provincia = htmlspecialchars($_POST['provincia'],ENT_QUOTES,'UTF-8');
    $ciudad = htmlspecialchars($_POST['ciudad'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    $ocupacion = htmlspecialchars($_POST['ocupacion'],ENT_QUOTES,'UTF-8');
    $valor_ingreso = htmlspecialchars($_POST['valor_ingreso'],ENT_QUOTES,'UTF-8');
    $valor_asegurado = htmlspecialchars($_POST['valor_asegurado'],ENT_QUOTES,'UTF-8');
    $prima_neta = htmlspecialchars($_POST['prima_neta'],ENT_QUOTES,'UTF-8');
    $prima_comisionable = htmlspecialchars($_POST['prima_comisionable'],ENT_QUOTES,'UTF-8');
    $prima_total = htmlspecialchars($_POST['prima_total'],ENT_QUOTES,'UTF-8');
    $tipo_pago = htmlspecialchars($_POST['tipo_pago'],ENT_QUOTES,'UTF-8');
    $forma_pago = htmlspecialchars($_POST['forma_pago'],ENT_QUOTES,'UTF-8');
    $estado_bayer = htmlspecialchars($_POST['estado_bayer'],ENT_QUOTES,'UTF-8');
    $listaColaboradores = $_POST['listaColaboradores'];
    $listaVehiculos = $_POST['listaVehiculos'];
    $listaObservaciones = $_POST['listaObservaciones'];
    $idUsuario = $_SESSION['S_IDUSUARIO'];
    $contra = password_hash($_POST['cedula'],PASSWORD_DEFAULT,['cost'=>12]);
    $fecha_seguimiento = htmlspecialchars($_POST['fecha_seguimiento'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Bayer_Persona_Empresarial();
    
    $consulta = $MU->Registrar_Prospecto($origen,$categoria,$idCliente,$cedula,$nombre_prospecto,$telefono,$email,$provincia,$ciudad,$direccion,$ocupacion,$valor_ingreso,$valor_asegurado,$prima_total,$tipo_pago,$forma_pago,$listaObservaciones,$idUsuario,$estado_bayer,$idProducto,$fechaActual,$proveedor,$contra,$fecha_seguimiento,$prima_comisionable,$prima_neta,$nueva_categoria,$listaColaboradores,$listaVehiculos);

    if ($estado_bayer == "CONTRATADO") {
        /*=============================================
        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL CONTRATO
        =============================================*/
        foreach ($consulta as $value) {
            $idBayer = $value["valor"];
        }

        $directorio = "../../view/contratos-pymes/".$idBayer;

        if(!is_dir($directorio)){ 
            mkdir($directorio, 0755);
        }

        switch ($categoria) {
            case '5':
                $ACE = new Envio_correo_notificacion_nuevo_contrato_accidentes_personales();
                $consulta2 = $ACE->realizar_envio_correo_notificacion_nuevo_contrato_accidentes_personales($idBayer);
                break;
            
            default:
                # code...
                break;
        }

    }
    
    echo json_encode($consulta);
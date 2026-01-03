<?php
    require '../../model/modelo_factura_cliente.php';

    session_start();

    date_default_timezone_set('America/Guayaquil');

    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $cedula = htmlspecialchars($_POST['cedula'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $numero_factura = htmlspecialchars($_POST['numero_factura'],ENT_QUOTES,'UTF-8');
    $fecha_emision = htmlspecialchars($_POST['fecha_emision'],ENT_QUOTES,'UTF-8');
    $valor_factura = htmlspecialchars($_POST['valor_factura'],ENT_QUOTES,'UTF-8');
    $forma_pago = htmlspecialchars($_POST['forma_pago'],ENT_QUOTES,'UTF-8');
    $extension = htmlspecialchars($_POST['extension'],ENT_QUOTES,'UTF-8');
    $nuevoNombreArchivo = "view/facturas/FAC".$ano.$mes.$dia.$hora.$minuto.$segundo.$cedula.$numero_factura.".".$extension;

    $MU = new Modelo_Factura_Cliente();
    $consulta = $MU->Registrar_factura_cliente($cedula,$nombre,$numero_factura,$fecha_emision,$valor_factura,$forma_pago,$nuevoNombreArchivo,$fechaActual);

        if (isset($_FILES["factura_documento"])) {
            $archivo = $_FILES["factura_documento"]["tmp_name"];
            $dato = move_uploaded_file($archivo,"../../".$nuevoNombreArchivo);
        }
    
    echo json_encode($consulta);
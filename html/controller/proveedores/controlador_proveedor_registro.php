<?php
    require '../../model/modelo_proveedor.php';

    date_default_timezone_set('America/Guayaquil');

    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $MU = new Modelo_Proveedor();
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    $listaCorreoReembolsos = $_POST['listaCorreoReembolsos'];
    $listaCorreoSiniestros = $_POST['listaCorreoSiniestros'];
    $listaCorreoOperatorios = $_POST['listaCorreoOperatorios'];
    $listaCorreoCreditoAmbulatorio = $_POST['listaCorreoCreditoAmbulatorio'];
    $listaCorreoSiniestrosHogar = $_POST['listaCorreoSiniestrosHogar'];

    $consulta = $MU->Registrar_Proveedor($nombre,$direccion,$listaCorreoReembolsos,$listaCorreoSiniestros,$listaCorreoOperatorios,$listaCorreoCreditoAmbulatorio,$listaCorreoSiniestrosHogar,$fechaActual);
    
    echo json_encode($consulta);
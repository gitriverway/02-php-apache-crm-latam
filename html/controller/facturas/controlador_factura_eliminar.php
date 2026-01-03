<?php
    require '../../model/modelo_factura_cliente.php';

    session_start();

    date_default_timezone_set('America/Guayaquil');

    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $idFactura = htmlspecialchars($_POST['idFactura'],ENT_QUOTES,'UTF-8');
    $ruta = "../../". $_POST['facturaRuta'];

    $MU = new Modelo_Factura_Cliente();
    $consulta = $MU->Eliminar_factura_cliente($idFactura);

    unlink($ruta);

    echo $consulta;
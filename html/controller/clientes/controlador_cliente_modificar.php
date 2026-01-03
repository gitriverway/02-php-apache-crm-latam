<?php
    require '../../model/modelo_cliente.php';

    $idCliente = htmlspecialchars($_POST['idCliente'],ENT_QUOTES,'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento'],ENT_QUOTES,'UTF-8');
    $genero = htmlspecialchars($_POST['genero'],ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
    $provincia = htmlspecialchars($_POST['provincia'],ENT_QUOTES,'UTF-8');
    $ciudad = htmlspecialchars($_POST['ciudad'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    $ocupacion = htmlspecialchars($_POST['ocupacion'],ENT_QUOTES,'UTF-8');
    $valor_ingreso = htmlspecialchars($_POST['valor_ingreso'],ENT_QUOTES,'UTF-8');

    $MU = new Modelo_Cliente();
    $consulta = $MU->Modificar_Cliente($idCliente,$cedula,$nombre,$fecha_nacimiento,$genero,$telefono,$email,$provincia,$ciudad,$direccion,$ocupacion,$valor_ingreso);

    echo json_encode($consulta);
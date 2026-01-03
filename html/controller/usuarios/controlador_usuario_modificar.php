<?php
    require '../../model/modelo_usuario.php';

    $MU = new Modelo_Usuario();
    $idUsuario = htmlspecialchars($_POST['idUsuario'],ENT_QUOTES,'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
    $empleado = htmlspecialchars($_POST['empleado'],ENT_QUOTES,'UTF-8');
    $rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');

    if ($_POST['contra_nueva'] != "") {
        $contra = password_hash($_POST['contra_nueva'],PASSWORD_DEFAULT,['cost'=>12]);
    }else {
        $contra = $_POST['contra_actual'];
    }

    $consulta = $MU->Modificar_Datos_Usuario($idUsuario,$usuario,$contra,$empleado,$email,$rol);

    echo json_encode($consulta);
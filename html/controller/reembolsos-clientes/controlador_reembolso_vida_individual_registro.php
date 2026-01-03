<?php
    require '../../model/modelo_reembolso_cliente.php';
    require '../../model/modelo_reembolso_cliente_documento.php';

    session_start();

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');

    $idBayer = htmlspecialchars($_POST['idBayer'],ENT_QUOTES,'UTF-8');
    $listaDatosReembolso = $_POST['listaDatosReembolso'];
    $idUsuario = $_SESSION['S_IDUSUARIO'];
    $idReembolso = "";


    $MU = new Modelo_Reembolso_Cliente();
    
    $consulta = $MU->Registrar_Reembolso($idBayer,$listaDatosReembolso,$fechaActual);

    for ($i=0; $i < count($consulta); $i++) { 
        $idReembolso = $consulta[0][$i];
    }    

    /*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL REEMBOLSOS
    =============================================*/

    $directorio = "../../view/reembolsos/".$idReembolso;
    $directorio1 = "view/reembolsos/".$idReembolso;

    mkdir($directorio, 0755);

    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $nombreArchivo = "DOCUMENTO";
    $rutaArchivo = $directorio1."/DOCUMENTO".$ano.$mes.$dia.$hora.$minuto.$segundo.".".$_POST["extension"];
            
    $archivo = $_FILES["documento"]["tmp_name"];
    $dato = move_uploaded_file($archivo,"../../".$rutaArchivo);

    $MCCD = new Modelo_Reembolso_Cliente_Documento();
    $consulta1 = $MCCD->Registrar_reembolso_cliente_documento($idReembolso,$nombreArchivo,$rutaArchivo,$fechaActual);

    echo json_encode($consulta);
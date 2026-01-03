<?php
    require '../../model/modelo_reembolso_cliente_empresarial.php';

    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date('Y-m-d').' '.date('H:i:s');
    $fechaActual1 = date('Y-m-d');

    $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');
    $estadoAnt = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
    $estado="";

    switch ($estadoAnt) {
        case 'ANULADO':
            $estado="PENDIENTE";
            break;
        case 'FINALIZADO':
            $estado="PROCESO";
            break;
        default:
        $estado=$estadoAnt;
            break;
    }

    $MU = new Modelo_Reembolso_Cliente_Empresarial();
    $consulta = $MU->Modificar_Reembolso_Reactivar($idReembolso,$estado);

    echo json_encode($consulta);
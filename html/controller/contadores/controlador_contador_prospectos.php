<?php

require '../../model/modelo_contador.php';

class ControladorContadorProspectos{

	static public function traer_contador_prospectos(){

        session_start();

        $MU = new Modelo_Contador();

        switch ($_SESSION['S_ROL']) {
            case 'GERENTE':
                $consulta = $MU->listar_contador_prospectos();
                break;
            case 'GERENTE 1':
                $consulta = $MU->listar_contador_prospectos();
                break;
            case 'VENDEDOR':
                $consulta = $MU->listar_contador_prospectos_asignado($_SESSION['S_IDUSUARIO']);
                break;
            default:
                # code...
                break;
        }

        // if ($_SESSION['S_ROL'] == "VENDEDOR") {
        //     $consulta = $MU->listar_contador_prospectos_asignado($_SESSION['S_IDUSUARIO']);
        // }else {
        //     $consulta = $MU->listar_contador_prospectos();
        // }

        echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorProspectos();
$fecha_actual -> traer_contador_prospectos();
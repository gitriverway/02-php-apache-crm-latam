<?php

require '../../model/modelo_contador.php';

class ControladorContadorReembolsosAsistenciaMedica{

	static public function traer_contador_reembolsos_asistencia_medica(){

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_reembolsos_asistencia_medica();
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorReembolsosAsistenciaMedica();
$fecha_actual -> traer_contador_reembolsos_asistencia_medica();
<?php

require '../../model/modelo_contador.php';

class ControladorContadorCreditoHospitalarioAsistenciaMedica{

	static public function traer_contador_creditos_hospitalarios_asistencia_medica(){

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_creditos_hospitalarios_asistencia_medica_empresarial();
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorCreditoHospitalarioAsistenciaMedica();
$fecha_actual -> traer_contador_creditos_hospitalarios_asistencia_medica();
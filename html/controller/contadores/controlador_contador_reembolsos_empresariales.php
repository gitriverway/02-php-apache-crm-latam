<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};


require '../../model/modelo_contador.php';

class ControladorContadorReembolsosAsistenciaMedicaPymes{

	static public function traer_contador_reembolsos_asistencia_medica_empresarial(){

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_reembolsos_asistencia_medica_empresarial();
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorReembolsosAsistenciaMedicaPymes();
$fecha_actual -> traer_contador_reembolsos_asistencia_medica_empresarial();
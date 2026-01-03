<?php

require '../../model/modelo_contador.php';

class ControladorContadorContratosAsistenciaMedicaPymes{

	static public function traer_contador_contratos_asistencia_medica_empresarial(){
        
    // 1	VIDA INDIVIDUAL
    // 2	VIDA COLECTIVA
    // 3	ASISTENCIA MEDICA INDIVIDUAL
    // 4	VEHICULOS
    // 5	ASISTENCIA MEDICA PYMES
    // 6	SEGURO DE VIAJES

    $idCategoria = "5";

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_contratos($idCategoria);
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorContratosAsistenciaMedicaPymes();
$fecha_actual -> traer_contador_contratos_asistencia_medica_empresarial();
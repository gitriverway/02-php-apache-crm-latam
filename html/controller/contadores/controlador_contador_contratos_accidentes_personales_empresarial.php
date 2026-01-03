<?php

require '../../model/modelo_contador.php';

class ControladorContadorContratosAccidentesPersonalesPymes{

	static public function traer_contador_contratos_accidentes_personales_empresarial(){
        
    // 1	VIDA INDIVIDUAL
    // 2	VIDA COLECTIVA
    // 3	ASISTENCIA MEDICA INDIVIDUAL
    // 4	VEHICULOS
    // 5	ACCIDENTES PERSONALES
    // 6	SEGURO DE VIAJES
    // 7	ACCIDENTES PERSONALES

    $idCategoria = "8";

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_contratos($idCategoria);
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorContratosAccidentesPersonalesPymes();
$fecha_actual -> traer_contador_contratos_accidentes_personales_empresarial();
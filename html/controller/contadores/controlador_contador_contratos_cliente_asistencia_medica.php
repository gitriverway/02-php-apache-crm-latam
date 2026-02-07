<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};


require '../../model/modelo_contador.php';

class ControladorContadorContratosClientesAsistenciaMedica{

	static public function traer_contador_contratos_clientes_asistencia_medica(){

    session_start();

    // 1	VIDA INDIVIDUAL
    // 2	VIDA COLECTIVA
    // 3	ASISTENCIA MEDICA INDIVIDUAL
    // 4	VEHICULOS
    // 5	ACCIDENTES PERSONALES
    // 6	SEGURO DE VIAJES

    $idCategoria = "3";

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_contratos_cliente($_SESSION['S_IDUSUARIO'],$idCategoria);
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorContratosClientesAsistenciaMedica();
$fecha_actual -> traer_contador_contratos_clientes_asistencia_medica();
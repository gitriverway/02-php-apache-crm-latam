<?php

require '../../model/modelo_contador.php';

class ControladorContadorProspectoWeb{

	static public function traer_contador_prospecto_web(){

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_prospecto_web();
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorProspectoWeb();
$fecha_actual -> traer_contador_prospecto_web();
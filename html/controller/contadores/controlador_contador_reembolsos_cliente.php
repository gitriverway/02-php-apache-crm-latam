<?php

require '../../model/modelo_contador.php';

class ControladorContadorReembolsosClientes{

	static public function traer_contador_reembolsos_clientes(){

    session_start();

    $MU = new Modelo_Contador();
    $consulta = $MU->listar_contador_reembolsos_cliente($_SESSION['S_IDUSUARIO']);
    echo json_encode($consulta);
	}
}

$fecha_actual = new ControladorContadorReembolsosClientes();
$fecha_actual -> traer_contador_reembolsos_clientes();
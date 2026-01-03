<?php

require '../../model/modelo_contador.php';

class ControladorContadorSiniestroVehiculoIndividual
{

    static public function traer_contador_siniestro_vehiculo_individual()
    {

        $MU = new Modelo_Contador();
        $consulta = $MU->listar_contador_siniestros_vehiculo_individual();
        echo json_encode($consulta);
    }
}

$fecha_actual = new ControladorContadorSiniestroVehiculoIndividual();
$fecha_actual->traer_contador_siniestro_vehiculo_individual();

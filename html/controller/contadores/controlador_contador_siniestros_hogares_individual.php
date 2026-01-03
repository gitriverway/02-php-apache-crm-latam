<?php

require '../../model/modelo_contador.php';

class ControladorContadorSiniestroHogarIndividual
{

    static public function traer_contador_siniestro_hogar_individual()
    {

        $MU = new Modelo_Contador();
        $consulta = $MU->listar_contador_siniestros_hogar_individual();
        echo json_encode($consulta);
    }
}

$fecha_actual = new ControladorContadorSiniestroHogarIndividual();
$fecha_actual->traer_contador_siniestro_hogar_individual();

<?php

require '../../model/modelo_contador.php';

class ControladorContadorContratosHogarIndividual
{

    static public function traer_contador_contratos_hogar_individual()
    {

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES
        // 7	ACCIDENTES PERSONALES
        // 9	ACCIDENTES PERSONALES

        $idCategoria = "9";

        $MU = new Modelo_Contador();
        $consulta = $MU->listar_contador_contratos($idCategoria);
        echo json_encode($consulta);
    }
}

$fecha_actual = new ControladorContadorContratosHogarIndividual();
$fecha_actual->traer_contador_contratos_hogar_individual();

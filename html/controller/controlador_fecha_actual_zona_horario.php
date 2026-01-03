<?php

class ControladorFechaActualZonaHorario{

	static public function traer_fecha_actual_zona_horario(){

        date_default_timezone_set("America/Guayaquil");
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $fechaActual = $fecha;

        echo $fechaActual;
	}
}

$fecha_actual = new ControladorFechaActualZonaHorario();
$fecha_actual -> traer_fecha_actual_zona_horario();
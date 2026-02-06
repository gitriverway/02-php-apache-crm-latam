<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};


class Controlador_Plantilla{

	static public function ctrPlantilla(){

		include "view/plantilla.php";

	}

}
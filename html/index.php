<?php
require_once __DIR__ . '/model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};


require_once "controller/controlador_plantilla.php";

require_once "controller/clientes/controlador_cliente_contar_contrato_cliente.php";

$plantilla = new Controlador_Plantilla();
$plantilla->ctrPlantilla();

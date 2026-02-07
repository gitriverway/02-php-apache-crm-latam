<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_bayer_persona_dependiente_empresarial.php';

    class Traer_datos_cliente{

        function mostrar_datoscliente(){

            $idCliente = $_POST["idCliente"];

            $MU = new Modelo_Bayer_Persona_Dependiente_Empresarial();

            $consulta = $MU->TraerDatosBayerDependiente($idCliente);

            echo json_encode($consulta);

        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUnicoCliente = new Traer_datos_cliente();
$listaUnicoCliente -> mostrar_datoscliente();
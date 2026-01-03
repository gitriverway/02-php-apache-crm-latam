<?php
    require '../../model/modelo_bayer_persona_empresarial.php';

    class Traer_datos_cliente{

        function mostrar_datoscliente(){

            $idCliente = $_POST["idCliente"];

            $tipo = "C";

            $MU = new Modelo_Bayer_Persona_Empresarial();

            $consulta = $MU->TraerDatosBayer($idCliente,$tipo);

            echo json_encode($consulta);

        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUnicoCliente = new Traer_datos_cliente();
$listaUnicoCliente -> mostrar_datoscliente();
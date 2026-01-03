<?php
    require '../../model/modelo_bayer_persona.php';

    class Traer_datos_prospecto{

        function mostrar_datos_prospecto(){

            $idProspecto = $_POST["idProspecto"];

            $tipo = "P";

            $MU = new Modelo_Bayer_Persona();

            $consulta = $MU->TraerDatosBayer($idProspecto,$tipo);

            echo json_encode($consulta);

        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUnicoCliente = new Traer_datos_prospecto();
$listaUnicoCliente -> mostrar_datos_prospecto();
<?php
    require '../../model/modelo_bayer_persona.php';

    class Lista_observacion_prospecto{

        function mostrar_lista_observacion_prospecto(){

            $idProspecto = htmlspecialchars($_POST['idProspecto'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Bayer_Persona();

            $consulta = $MU->listar_observacion_prospecto($idProspecto);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_observacion_prospecto();
$listaUsuario -> mostrar_lista_observacion_prospecto();
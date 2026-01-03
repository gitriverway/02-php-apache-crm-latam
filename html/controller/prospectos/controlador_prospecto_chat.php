<?php
    require '../../model/modelo_bayer_persona.php';

    class Lista_chat_prospecto{

        function mostrar_lista_chat_prospecto(){

            $idProspecto = htmlspecialchars($_POST['idProspecto'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Bayer_Persona();

            $consulta = $MU->listar_prospecto_chat($idProspecto);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTA CHAT PROSPECTOS
=============================================*/
$listachat = new Lista_chat_prospecto();
$listachat -> mostrar_lista_chat_prospecto();
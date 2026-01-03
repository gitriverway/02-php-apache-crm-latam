<?php
    require '../../model/modelo_prospecto_web.php';

    class Lista_chat_prospecto_web{

        function mostrar_lista_chat_prospecto_web(){

            $idProspecto = htmlspecialchars($_POST['idProspecto'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Prospecto_Web();

            $consulta = $MU->listar_prospecto_web_chat($idProspecto);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTA CHAT PROSPECTO WEB
=============================================*/
$listachat = new Lista_chat_prospecto_web();
$listachat -> mostrar_lista_chat_prospecto_web();
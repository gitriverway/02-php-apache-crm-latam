<?php

    require '../../model/modelo_bayer_persona_empresarial.php';

    class Lista_dependientes{

        function mostrar_lista_dependientes(){

            $idBayer = $_POST["idBayer"];
            $idContrato = $_POST["idContrato"];

            $MU = new Modelo_Bayer_Persona_Empresarial();

            $consulta = $MU->listar_dependientes_asistencia_medica($idBayer,$idContrato);

            $lista = $consulta[0]["cliente_familiares"];

            echo $lista;

        }

    }


/*=============================================
LISTAR TABLA CLIENTES
=============================================*/
$listaUsuario = new Lista_dependientes();
$listaUsuario -> mostrar_lista_dependientes();
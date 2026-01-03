<?php

    require '../../model/modelo_bayer_persona.php';

    class Lista_dependientes{

        function mostrar_lista_dependientes(){

            $idBayer = $_POST["idBayer"];
            $idContrato = $_POST["idContrato"];

            $MU = new Modelo_Bayer_Persona();

            $consulta = $MU->listar_hogares_individual($idBayer,$idContrato);

            $lista = $consulta[0]["cliente_hogares"];

            echo $lista;

        }

    }


/*=============================================
LISTAR TABLA CLIENTES
=============================================*/
$listaUsuario = new Lista_dependientes();
$listaUsuario -> mostrar_lista_dependientes();
<?php

require '../../model/modelo_bayer_persona_empresarial.php';

class Lista_transporte
{
    function mostrar_lista_transporte()
    {

        $idBayer = $_POST["idBayer"];
        $idContrato = $_POST["idContrato"];

        $MU = new Modelo_Bayer_Persona_Empresarial();

        $consulta = $MU->listar_dependientes_transporte_empresarial($idBayer, $idContrato);

        $lista = $consulta[0]["cliente_transportes"];

        echo $lista;
    }
}


/*=============================================
LISTAR TABLA CLIENTES
=============================================*/
$listaUsuario = new Lista_transporte();
$listaUsuario->mostrar_lista_transporte();
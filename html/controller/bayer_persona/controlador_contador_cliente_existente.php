<?php

require '../../model/modelo_bayer_persona.php';

class Lista_cliente_contrato_existente
{
    function mostrar_lista_cliente_contrato_existente()
    {

        $idCliente = $_POST["cedula"];

        $MU = new Modelo_Bayer_Persona();

        $consulta = $MU->listar_cliente_contrato_existe($idCliente);

        $lista = $consulta[0]["contador"];

        echo $lista;
    }
}


/*=============================================
LISTAR TABLA CLIENTES
=============================================*/
$listaUsuario = new Lista_cliente_contrato_existente();
$listaUsuario->mostrar_lista_cliente_contrato_existente();
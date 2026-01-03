<?php
    require '../../model/modelo_reembolso_cliente.php';

    class Lista_documentos_solictado_aseguradora_reembolsos{

        function mostrar_lista_documento_solicitada_aseguradora_reembolso(){

            $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Reembolso_Cliente();

            $consulta = $MU->listar_documentos_solicitados_aseguradora_reembolsos($idReembolso);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_documentos_solictado_aseguradora_reembolsos();
$listaUsuario -> mostrar_lista_documento_solicitada_aseguradora_reembolso();
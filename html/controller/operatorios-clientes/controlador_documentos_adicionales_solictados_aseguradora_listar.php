<?php
    require '../../model/modelo_operatorio_cliente.php';

    class Lista_documentos_solictado_aseguradora_operatorios{

        function mostrar_lista_documento_solicitada_aseguradora_operatorio(){

            $idOperatorio = htmlspecialchars($_POST['idOperatorio'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Operatorio_Cliente();

            $consulta = $MU->listar_documentos_solicitados_aseguradora_operatorios($idOperatorio);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_documentos_solictado_aseguradora_operatorios();
$listaUsuario -> mostrar_lista_documento_solicitada_aseguradora_operatorio();
<?php
    require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';

    class Lista_documentos_solictado_aseguradora_creditos_ambulatorios{

        function mostrar_lista_documento_solicitada_aseguradora_credito_ambulatorio(){

            $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();

            $consulta = $MU->listar_documentos_solicitados_aseguradora_creditos_ambulatorios($idCreditoAmbulatorio);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_documentos_solictado_aseguradora_creditos_ambulatorios();
$listaUsuario -> mostrar_lista_documento_solicitada_aseguradora_credito_ambulatorio();
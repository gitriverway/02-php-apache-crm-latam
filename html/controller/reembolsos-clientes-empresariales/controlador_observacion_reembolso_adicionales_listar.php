<?php
    require '../../model/modelo_reembolso_cliente_empresarial.php';

    class Lista_observacion_reembolsos{

        function mostrar_lista_observacion_reembolso(){

            $idReembolso = htmlspecialchars($_POST['idReembolso'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Reembolso_Cliente_Empresarial();

            $consulta = $MU->listar_observacion_reembolsos($idReembolso);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_observacion_reembolsos();
$listaUsuario -> mostrar_lista_observacion_reembolso();
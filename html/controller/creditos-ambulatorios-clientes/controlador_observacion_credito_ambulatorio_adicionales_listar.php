<?php
    require '../../model/modelo_credito_ambulatorio_cliente.php';

    class Lista_observacion_creditos_ambulatorios{

        function mostrar_lista_observacion_credito_ambulatorio(){

            $idCreditoAmbulatorio = htmlspecialchars($_POST['idCreditoAmbulatorio'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Credito_Ambulatorio_Cliente();

            $consulta = $MU->listar_observacion_creditos_ambulatorios($idCreditoAmbulatorio);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_observacion_creditos_ambulatorios();
$listaUsuario -> mostrar_lista_observacion_credito_ambulatorio();
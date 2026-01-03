<?php
    require '../../model/modelo_bayer_persona.php';

    class Lista_asignar_cliente{

        function mostrar_lista_asignar_cliente(){

            $idCliente = htmlspecialchars($_POST['idCliente'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Bayer_Persona();

            $consulta = $MU->listar_observacion_cliente($idCliente);

            echo json_encode($consulta);
        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUsuario = new Lista_asignar_cliente();
$listaUsuario -> mostrar_lista_asignar_cliente();
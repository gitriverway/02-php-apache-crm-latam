<?php
    require '../../model/modelo_cliente.php';

    class Traer_datos_cliente{

        function mostrar_datoscliente(){

            $idCliente = $_POST["idCliente"];

            $MU = new Modelo_Cliente();

            $consulta = $MU->TraerDatosCliente($idCliente);

            echo json_encode($consulta);

        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUnicoCliente = new Traer_datos_cliente();
$listaUnicoCliente -> mostrar_datoscliente();
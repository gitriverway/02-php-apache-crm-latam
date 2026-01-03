<?php
    require '../../model/modelo_cliente.php';

    class Traer_datos_cliente_cedula{

        function mostrar_datoscliente_cedula(){

            $cedula = $_POST["cedula"];

            $MU = new Modelo_Cliente();

            $consulta = $MU->TraerDatosClienteCedula($cedula);

            echo json_encode($consulta);

        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUnicoCliente = new Traer_datos_cliente_cedula();
$listaUnicoCliente -> mostrar_datoscliente_cedula();
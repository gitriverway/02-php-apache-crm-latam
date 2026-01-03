<?php
require '../../model/modelo_contrato_cliente_empresarial.php';

class Lista_contrato_cliente_seleccionado
{

    function mostrar_lista_contrato_cliente_seleccionado()
    {

        session_start();

        $idUsuario = $_SESSION['S_IDUSUARIO'];
        $fecha = $_GET["fecha"];

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "16";

        $MU = new Modelo_Contrato_Cliente_Empresarial();

        $consulta = $MU->listar_contrato_cliente_seleccionado($idUsuario, $idCategoria, $fecha);

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {

                $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeleccionarContrato btn btn-primary' idCliente='" . $consulta[$i]["bayer_id"] . "' numeroContrato = '" . $consulta[$i]["contrato_numero"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' proveedor_descripcion='" . $consulta[$i]["proveedor_descripcion"] . "' ><i class='fa fa-eye'></i></button></div>";

                $datosJson .= '[
                            "' . $consulta[$i]["posicion"] . '",
                            "' . $consulta[$i]["proveedor_descripcion"] . '",
                            "' . $consulta[$i]["producto_id"] . '",
                            "' . $consulta[$i]["cliente_ci"] . '",
                            "' . $consulta[$i]["cliente_nombre"] . '",
                            "' . $consulta[$i]["contrato_numero"] . '",
                            "' . $botones . '"
                    ],';
            }

            $datosJson = substr($datosJson, 0, -1);

            $datosJson .=   ']

                }';
            echo $datosJson;
        }
    }
}


/*=============================================
LISTA TABLA DE PROSPECTO
=============================================*/
$listaProspecto = new Lista_contrato_cliente_seleccionado();
$listaProspecto->mostrar_lista_contrato_cliente_seleccionado();
<?php
require '../../model/modelo_contrato_cliente.php';

class Lista_contrato_cliente
{

    function mostrar_lista_contrato_cliente()
    {

        session_start();

        $idUsuario = $_SESSION['S_IDUSUARIO'];

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "1";

        $estado = "ACTIVO";

        $MU = new Modelo_Contrato_Cliente();
        $consulta = $MU->listar_contrato_cliente($idUsuario, $idCategoria, $estado);

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {
                if ($consulta[$i]["CÉDULA"] != "") {
                    $btnCedula = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["CÉDULA"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnCedula = "";
                }

                if ($consulta[$i]["COTIZACIÓN"] != "") {
                    $btnCotizacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["COTIZACIÓN"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnCotizacion = "";
                }

                if ($consulta[$i]["CARTA NOMBRAMIENTO"] != "") {
                    $btnCartaNombramiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["CARTA NOMBRAMIENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnCartaNombramiento = "";
                }

                if ($consulta[$i]["SOLICITUD AFILIACIÓN"] != "") {
                    $btnSolicitudAfiliacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["SOLICITUD AFILIACIÓN"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnSolicitudAfiliacion = "";
                }

                if ($consulta[$i]["CONTRATO"] != "") {
                    $btnContrato = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["CONTRATO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnContrato = "";
                }

                if ($consulta[$i]["FACTURA"] != "") {
                    $btnFactura = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["FACTURA"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnFactura = "";
                }

                if ($consulta[$i]["DÉBITO BANCARIO ACTUAL"] != "") {
                    $btnDebitoBancario = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DÉBITO BANCARIO ACTUAL"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnDebitoBancario = "";
                }

                $estado = "<button class='btn btn-xs btn-success' estado='" . $consulta[$i]["cliente_estado_bayer"] . "'>" . $consulta[$i]["cliente_estado_bayer"] . "</button>";

                $datosJson .= '[
                        "' . $consulta[$i]["posicion"] . '",
                        "' . $consulta[$i]["contrato_numero"] . '",
                        "' . $consulta[$i]["contrato_fecha_inicio"] . '",
                        "' . $consulta[$i]["contrato_fecha_fin"] . '",
                        "' . $consulta[$i]["cliente_productos"] . '",
                        "' . $consulta[$i]["cliente_valor_asegurado"] . '",
                        "' . $btnCedula . '",
                        "' . $btnCotizacion . '",
                        "' . $btnCartaNombramiento . '",
                        "' . $btnSolicitudAfiliacion . '",
                        "' . $btnContrato . '",
                        "' . $btnFactura . '",
                        "' . $btnDebitoBancario . '",
                        "' . $estado . '"
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
$listaProspecto = new Lista_contrato_cliente();
$listaProspecto->mostrar_lista_contrato_cliente();
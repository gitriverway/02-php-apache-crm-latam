<?php
require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';

class Lista_credito_ambulatorio_cliente
{

    function mostrar_lista_credito_ambulatorio_cliente()
    {

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "5";

        $MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();

        $consulta = $MU->listar_credito_ambulatorio_asistencia_medica($idCategoria);

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {
                $credito_ambulatorio_descripcion = $consulta[$i]["credito_ambulatorio_descripcion"];

                $lista = json_decode($credito_ambulatorio_descripcion, true);

                $paciente = "";
                $nombre_paciente = "";
                $diagnostico = "";
                $valor = "";

                foreach ($lista as $value) {
                    $paciente .= $value["nombre_paciente"];
                    $nombre_paciente .= "<p>" . $value["nombre_paciente"] . "</p>";
                    $diagnostico .= "<p align='center'>" . $value["diagnostico"] . "</p>";
                    $valor .= "<p>" . $value["valor_presentado"] . "</p>";
                }

                $btnObservaciones = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerObservaciones btn btn-primary' idCreditoAmbulatorio = '" . $consulta[$i]["credito_ambulatorio_id"] . "' paciente='" . $paciente . "'><i class='fa fa-search'></i></button></div>";

                switch ($consulta[$i]["credito_ambulatorio_estatus"]) {
                    case 'PENDIENTE':
                        $estado = "<button class='btn btn-xs btn-warning'>" . $consulta[$i]["credito_ambulatorio_estatus"] . "</button>";
                        break;
                    case 'PROCESO':
                        $estado = "<button class='btn btn-xs btn-primary'>" . $consulta[$i]["credito_ambulatorio_estatus"] . "</button>";
                        break;
                    case 'ANULADO':
                        $estado = "<button class='btn btn-xs btn-danger'>" . $consulta[$i]["credito_ambulatorio_estatus"] . "</button>";
                        break;
                    case 'FINALIZADO':
                        $estado = "<button class='btn btn-xs btn-success'>" . $consulta[$i]["credito_ambulatorio_estatus"] . "</button>";
                        break;
                    default:
                        $estado = "";
                        break;
                }

                if ($consulta[$i]["DOCUMENTO"] != "") {
                    if ($consulta[$i]["credito_ambulatorio_estatus"] == "PENDIENTE") {
                        $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO"] . "'><i class='fas fa-file-pdf'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnValidarDocumentosCreditoAmbulatorio btn btn-warning' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                    }
                } else {
                    $btnDocumento = "";
                }

                if ($consulta[$i]["credito_ambulatorio_estatus"] == "PROCESO") {
                    $btnObservacionAdicional = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarObservacionesAdicionales btn btn-primary' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                } else {
                    $btnObservacionAdicional = "";
                }


                if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] != "") {
                    $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["credito_ambulatorio_estatus"] == "PROCESO") {
                        $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeguimientoCreditoAmbulatorioAseguradora btn btn-success' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnSeguimiento = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] != "") {
                    $btnSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["credito_ambulatorio_estatus"] == "PROCESO") {
                        $btnSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeguimientoCreditoAmbulatorioAseguradora1 btn btn-success' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnSeguimiento1 = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO"] != "") {
                    $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoSeguimiento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_SEGUIMIENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["credito_ambulatorio_estatus"] == "PROCESO") {
                        $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarDocumentoSeguimiento btn btn-warning' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-edit'></i></button></div>";
                    } else {
                        $btnDocumentoSeguimiento = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] != "") {
                    $btnDocumentoSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoSeguimiento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["credito_ambulatorio_estatus"] == "PROCESO") {
                        $btnDocumentoSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarDocumentoSeguimiento1 btn btn-warning' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-edit'></i></button></div>";
                    } else {
                        $btnDocumentoSeguimiento1 = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_AUTORIZACION"] != "") {
                    $btnDocumentoAutorizacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoAutorizacion btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_AUTORIZACION"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["credito_ambulatorio_estatus"] == "PROCESO") {
                        $btnDocumentoAutorizacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarAutorizacion btn btn-warning' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' idBayer='" . $consulta[$i]["bayer_id"] . "' paciente='" . $paciente . "'><i class='fas fa-edit'></i></button></div>";

                        $btnDocumentoAutorizacion .= "&nbsp;<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarAnulacion btn btn-danger' idCreditoAmbulatorio='" . $consulta[$i]["credito_ambulatorio_id"] . "' idBayer='" . $consulta[$i]["bayer_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-times'></i></button></div>";
                    } else {
                        $btnDocumentoAutorizacion = "";
                    }
                }

                $datosJson .= '[
                            "' . $consulta[$i]["posicion"] . '",
                            "' . $consulta[$i]["credito_ambulatorio_id"] . '",
                            "' . $consulta[$i]["credito_ambulatorio_fecha_registro"] . '",
                            "' . $paciente . '",
                            "' . $diagnostico . '",
                            "' . $valor . '",
                            "' . $btnDocumento . '",
                            "' . $consulta[$i]["credito_ambulatorio_fecha_envio_aseguradora"] . '",
                            "' . $btnObservaciones . '",
                            "' . $estado . '",
                            "' . $consulta[$i]["credito_ambulatorio_fecha_seguimiento"] . '",
                            "' . $btnObservacionAdicional . '",
                            "' . $btnSeguimiento . '",
                            "' . $btnSeguimiento1 . '",
                            "' . $btnDocumentoSeguimiento . '",
                            "' . $btnDocumentoSeguimiento1 . '",
                            "' . $consulta[$i]["credito_ambulatorio_fecha_autorizacion_aseguradora"] . '",
                            "' . $btnDocumentoAutorizacion . '"
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
$listaProspecto = new Lista_credito_ambulatorio_cliente();
$listaProspecto->mostrar_lista_credito_ambulatorio_cliente();
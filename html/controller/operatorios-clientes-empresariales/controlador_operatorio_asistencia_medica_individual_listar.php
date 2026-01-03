<?php
require '../../model/modelo_operatorio_cliente_empresarial.php';

class Lista_operatorio_cliente
{

    function mostrar_lista_operatorio_cliente()
    {

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "5";

        $MU = new Modelo_Operatorio_Cliente_Empresarial();

        $consulta = $MU->listar_operatorio_asistencia_medica($idCategoria);

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {
                $operatorio_descripcion = $consulta[$i]["operatorio_descripcion"];

                $lista = json_decode($operatorio_descripcion, true);

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

                $btnObservaciones = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerObservaciones btn btn-primary' idOperatorio = '" . $consulta[$i]["operatorio_id"] . "' paciente = '" . $paciente . "'><i class='fa fa-search'></i></button></div>";

                switch ($consulta[$i]["operatorio_estatus"]) {
                    case 'PENDIENTE':
                        $estado = "<button class='btn btn-xs btn-warning'>" . $consulta[$i]["operatorio_estatus"] . "</button>";
                        break;
                    case 'PROCESO':
                        $estado = "<button class='btn btn-xs btn-primary'>" . $consulta[$i]["operatorio_estatus"] . "</button>";
                        break;
                    case 'ANULADO':
                        $estado = "<button class='btn btn-xs btn-danger'>" . $consulta[$i]["operatorio_estatus"] . "</button>";
                        break;
                    case 'FINALIZADO':
                        $estado = "<button class='btn btn-xs btn-success'>" . $consulta[$i]["operatorio_estatus"] . "</button>";
                        break;
                    default:
                        $estado = "";
                        break;
                }

                if ($consulta[$i]["DOCUMENTO"] != "") {
                    if ($consulta[$i]["operatorio_estatus"] == "PENDIENTE") {
                        $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO"] . "'><i class='fas fa-file-pdf'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnValidarDocumentosOperatorio btn btn-warning' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                    }
                } else {
                    $btnDocumento = "";
                }

                if ($consulta[$i]["operatorio_estatus"] == "PROCESO") {
                    $btnObservacionAdicional = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarObservacionesAdicionales btn btn-primary' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                } else {
                    $btnObservacionAdicional = "";
                }



                if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] != "") {
                    $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["operatorio_estatus"] == "PROCESO") {
                        $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeguimientoOperatorioAseguradora btn btn-success' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnSeguimiento = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] != "") {
                    $btnSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["operatorio_estatus"] == "PROCESO") {
                        $btnSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeguimientoOperatorioAseguradora1 btn btn-success' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnSeguimiento1 = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO"] != "") {
                    $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoSeguimiento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_SEGUIMIENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["operatorio_estatus"] == "PROCESO") {
                        $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarDocumentoSeguimiento btn btn-warning' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fas fa-edit'></i></button></div>";
                    } else {
                        $btnDocumentoSeguimiento = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] != "") {
                    $btnDocumentoSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoSeguimiento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["operatorio_estatus"] == "PROCESO") {
                        $btnDocumentoSeguimiento1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarDocumentoSeguimiento1 btn btn-warning' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fas fa-edit'></i></button></div>";
                    } else {
                        $btnDocumentoSeguimiento1 = "";
                    }
                }


                if ($consulta[$i]["DOCUMENTO_AUTORIZACION"] != "") {
                    $btnDocumentoAutorizacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoAutorizacion btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_AUTORIZACION"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["operatorio_estatus"] == "PROCESO") {
                        $btnDocumentoAutorizacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarAutorizacion btn btn-warning' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' idBayer='" . $consulta[$i]["bayer_id"] . "' paciente = '" . $paciente . "'><i class='fas fa-edit'></i></button></div>";

                        $btnDocumentoAutorizacion .= "&nbsp;<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarAnulacion btn btn-danger' idOperatorio='" . $consulta[$i]["operatorio_id"] . "' idBayer='" . $consulta[$i]["bayer_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente = '" . $paciente . "'><i class='fas fa-times'></i></button></div>";
                    } else {
                        $btnDocumentoAutorizacion = "";
                    }
                }

                $datosJson .= '[
                            "' . $consulta[$i]["posicion"] . '",
                            "' . $consulta[$i]["operatorio_id"] . '",
                            "' . $consulta[$i]["operatorio_fecha_registro"] . '",
                            "' . $nombre_paciente . '",
                            "' . $diagnostico . '",
                            "' . $valor . '",
                            "' . $btnDocumento . '",
                            "' . $consulta[$i]["operatorio_fecha_envio_aseguradora"] . '",
                            "' . $btnObservaciones . '",
                            "' . $estado . '",
                            "' . $consulta[$i]["operatorio_fecha_seguimiento"] . '",
                            "' . $btnObservacionAdicional . '",
                            "' . $btnSeguimiento . '",
                            "' . $btnSeguimiento1 . '",
                            "' . $btnDocumentoSeguimiento . '",
                            "' . $btnDocumentoSeguimiento1 . '",
                            "' . $consulta[$i]["operatorio_fecha_autorizacion_aseguradora"] . '",
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
$listaProspecto = new Lista_operatorio_cliente();
$listaProspecto->mostrar_lista_operatorio_cliente();
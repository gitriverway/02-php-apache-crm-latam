<?php
require '../../model/modelo_reembolso_cliente.php';

class Lista_reembolso_cliente
{

    function mostrar_lista_reembolso_cliente()
    {

        session_start();

        $idUsuario = $_SESSION['S_IDUSUARIO'];
        $rol = $_SESSION['S_ROL'];

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "3";

        $MU = new Modelo_Reembolso_Cliente();

        $consulta = $MU->listar_reembolso_asistencia_medica($idCategoria);

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {
                $reembolso_descripcion = $consulta[$i]["reembolso_descripcion"];

                $lista = json_decode($reembolso_descripcion, true);

                $paciente = "";
                $nombre_paciente = "";
                $diagnostico = "";
                $fecha_atencion = "";
                $valor = "";

                foreach ($lista as $value) {
                    $paciente .= $value["nombre_paciente"];
                    $nombre_paciente .= "<p>" . $value["nombre_paciente"] . "</p>";
                    $diagnostico .= "<p align='center'>" . $value["diagnostico"] . "</p>";
                    $fecha_atencion .= "<p align='center'>" . $value["fecha_atencion"] . "</p>";
                    $valor .= "<p>" . $value["valor_presentado"] . "</p>";
                }

                $btnObservaciones = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerObservaciones btn btn-primary' idReembolso = '" . $consulta[$i]["reembolso_id"] . "' paciente = '" . $paciente . "'><i class='fa fa-search'></i></button></div>";

                switch ($consulta[$i]["reembolso_estatus"]) {
                    case 'PENDIENTE':
                        $estado = "<button class='btn btn-xs btn-warning'>" . $consulta[$i]["reembolso_estatus"] . "</button>";
                        break;
                    case 'PROCESO':
                        $estado = "<button class='btn btn-xs btn-primary'>" . $consulta[$i]["reembolso_estatus"] . "</button>";

                        break;
                    case 'ANULADO':
                        if ($rol == "GERENTE") {
                            $estado = "<button class='btn btn-xs btn-danger btnCambiarEstado' idReembolso='" . $consulta[$i]["reembolso_id"] . " estado='" . $consulta[$i]["reembolso_estatus"] . "' paciente='" . $paciente . "'>" . $consulta[$i]["reembolso_estatus"] . "</button>";
                        } else {
                            $estado = "<button class='btn btn-xs btn-danger'>" . $consulta[$i]["reembolso_estatus"] . "</button>";
                        }
                        break;
                    case 'FINALIZADO':
                        if ($rol == "GERENTE") {
                            $estado = "<button class='btn btn-xs btn-success btnCambiarEstado' idReembolso='" . $consulta[$i]["reembolso_id"] . " estado='" . $consulta[$i]["reembolso_estatus"] . "' paciente='" . $paciente . "'>" . $consulta[$i]["reembolso_estatus"] . "</button>";
                        } else {
                            $estado = "<button class='btn btn-xs btn-success'>" . $consulta[$i]["reembolso_estatus"] . "</button>";
                        }
                        break;
                    case 'CADUCADO':
                        $estado = "<button class='btn btn-xs btn-danger'>" . $consulta[$i]["reembolso_estatus"] . "</button>";
                        break;
                    default:
                        $estado = "";
                        break;
                }

                if ($consulta[$i]["DOCUMENTO"] != "") {
                    if ($consulta[$i]["reembolso_estatus"] == "PENDIENTE") {
                        $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO"] . "'><i class='fas fa-file-pdf'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnValidarDocumentosReembolso btn btn-warning' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                    }
                } else {
                    $btnDocumento = "";
                }

                if ($consulta[$i]["reembolso_estatus"] == "PROCESO") {
                    $btnObservacionAdicional = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarObservacionesAdicionales btn btn-primary' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                } else {
                    $btnObservacionAdicional = "";
                }

                if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] != "") {
                    $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["reembolso_estatus"] == "PROCESO") {
                        $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeguimientoReembolsoAseguradora btn btn-success' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnSeguimiento = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] != "") {
                    $btnSeguimiento_1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["reembolso_estatus"] == "PROCESO") {
                        $btnSeguimiento_1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeguimientoReembolsoAseguradora_1 btn btn-success' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fa fa-edit'></i></button></div>";
                    } else {
                        $btnSeguimiento_1 = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO"] != "") {
                    $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_SEGUIMIENTO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["reembolso_estatus"] == "PROCESO") {
                        $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarDocumentoSeguimiento btn btn-warning' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-edit'></i></button></div>";
                    } else {
                        $btnDocumentoSeguimiento = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] != "") {
                    $btnDocumentoSeguimiento_1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["reembolso_estatus"] == "PROCESO") {
                        $btnDocumentoSeguimiento_1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarDocumentoSeguimiento_1 btn btn-warning' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-edit'></i></button></div>";
                    } else {
                        $btnDocumentoSeguimiento_1 = "";
                    }
                }

                if ($consulta[$i]["DOCUMENTO_LIQUIDACION"] != "") {
                    $btnDocumentoLiquidacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["DOCUMENTO_LIQUIDACION"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    if ($consulta[$i]["reembolso_estatus"] == "PROCESO") {
                        $btnDocumentoLiquidacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarLiquidacion btn btn-warning' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idBayer='" . $consulta[$i]["bayer_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-edit'></i></button></div>";

                        $btnDocumentoLiquidacion .= "&nbsp;<div class='btn-group'><button style='font-size:13px;' type='button' class='btnAgregarAnulacion btn btn-danger' idReembolso='" . $consulta[$i]["reembolso_id"] . "' idBayer='" . $consulta[$i]["bayer_id"] . "' idContrato='" . $consulta[$i]["contrato_id"] . "' paciente='" . $paciente . "'><i class='fas fa-times'></i></button></div>";
                    } else {
                        $btnDocumentoLiquidacion = "";
                    }
                }

                $datosJson .= '[
                            "' . $consulta[$i]["reembolso_id"] . '",
                            "' . $fecha_atencion . '",
                            "' . $consulta[$i]["reembolso_fecha_registro"] . '",
                            "' . $nombre_paciente . '",
                            "' . $diagnostico . '",
                            "' . $valor . '",
                            "' . $btnDocumento . '",
                            "' . $consulta[$i]["reembolso_fecha_envio_aseguradora"] . '",
                            "' . $btnObservaciones . '",
                            "' . $estado . '",
                            "' . $consulta[$i]["reembolso_fecha_seguimiento"] . '",
                            "' . $btnObservacionAdicional . '",
                            "' . $btnSeguimiento . '",
                            "' . $btnSeguimiento_1 . '",
                            "' . $btnDocumentoSeguimiento . '",
                            "' . $btnDocumentoSeguimiento_1 . '",
                            "' . $consulta[$i]["reembolso_valor_presentado"] . '",
                            "' . $consulta[$i]["reembolso_valor_cobrado"] . '",
                            "' . $consulta[$i]["reembolso_valor_no_cubierto"] . '",
                            "' . $consulta[$i]["reembolso_valor_copago"] . '",
                            "' . $consulta[$i]["reembolso_valor_reembolsado"] . '",
                            "' . $consulta[$i]["reembolso_saldo_deducible"] . '",
                            "' . $consulta[$i]["reembolso_fecha_liquidacion_aseguradora"] . '",
                            "' . $btnDocumentoLiquidacion . '"
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
$listaProspecto = new Lista_reembolso_cliente();
$listaProspecto->mostrar_lista_reembolso_cliente();

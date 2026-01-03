<?php
    require '../../model/modelo_reembolso_cliente_empresarial.php';

    class Lista_reembolso_cliente{

        function mostrar_lista_reembolso_cliente(){

            session_start();

            $idUsuario = $_SESSION['S_IDUSUARIO'];

            // 1	VIDA INDIVIDUAL
            // 2	VIDA COLECTIVA
            // 3	ASISTENCIA MEDICA INDIVIDUAL
            // 4	VEHICULOS
            // 5	ACCIDENTES PERSONALES
            // 6	SEGURO DE VIAJES

            $idCategoria = "5";

            $MU = new Modelo_Reembolso_Cliente_Empresarial();

            $consulta = $MU->listar_reembolso_cliente_asistencia_medica($idUsuario,$idCategoria);            

            if(!$consulta){

                echo '{"data": []}';

            }else{

                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        $reembolso_descripcion = $consulta[$i]["reembolso_descripcion"];

                        $lista = json_decode($reembolso_descripcion, true);

                        $paciente = "";
                        $diagnostico = "";
                        $fecha_atencion = "";
                        $valor = "";

                            foreach ($lista as $value) {
                                $paciente.= $value["nombre_paciente"];
                                $diagnostico .= $value["diagnostico"];
                                $fecha_atencion .= $value["fecha_atencion"];
                                $valor .= $value["valor_presentado"];
                            }
                        
                        $btnObservaciones = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerObservaciones btn btn-primary' idReembolso = '".$consulta[$i]["reembolso_id"]."'><i class='fa fa-search'></i></button></div>";

                        switch ($consulta[$i]["reembolso_estatus"]) {
                            case 'PENDIENTE':
                                $estado = "<button class='btn btn-xs btn-warning'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                            case 'PROCESO':
                                $estado = "<button class='btn btn-xs btn-primary'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                            case 'ANULADO':
                                $estado = "<button class='btn btn-xs btn-danger'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                            case 'FINALIZADO':
                                $estado = "<button class='btn btn-xs btn-success'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                                case 'CADUCADO':
                                    $estado = "<button class='btn btn-xs btn-danger'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                    break;
                            default:
                                # code...
                                break;
                        }

                        if ($consulta[$i]["DOCUMENTO"] != "") {
                            $btnDocumento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnDocumento = "";
                        }

                        if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"] != "") {
                            $btnSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnSeguimiento = "";
                        }
                        
                        if ($consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"] != "") {
                            $btnSeguimiento_1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnSeguimiento_1 = "";
                        }

                        if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO"] != "") {
                            $btnDocumentoSeguimiento = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO_SEGUIMIENTO"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnDocumentoSeguimiento = "";
                        }

                        if ($consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"] != "") {
                            $btnDocumentoSeguimiento_1 = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO_SEGUIMIENTO_1"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnDocumentoSeguimiento_1 = "";
                        }

                        if ($consulta[$i]["DOCUMENTO_LIQUIDACION"] != "") {
                            $btnDocumentoLiquidacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoLiquidacion btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO_LIQUIDACION"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnDocumentoLiquidacion = "";
                        }
                        
                        $datosJson .='[
                            "'.$consulta[$i]["reembolso_id"].'",
                            "'.$fecha_atencion.'",
                            "'.$consulta[$i]["reembolso_fecha_registro"].'",
                            "'.$paciente.'",
                            "'.$diagnostico.'",
                            "'.$valor.'",
                            "'.$estado.'",
                            "'.$btnDocumento.'",
                            "'.$btnSeguimiento.'",
                            "'.$btnSeguimiento_1.'",
                            "'.$btnDocumentoSeguimiento.'",
                            "'.$btnDocumentoSeguimiento_1.'",
                            "'.$btnObservaciones.'",
                            "'.$consulta[$i]["reembolso_fecha_modificado"].'",
                            "'.$consulta[$i]["reembolso_valor_presentado"].'",
                            "'.$consulta[$i]["reembolso_valor_cobrado"].'",
                            "'.$consulta[$i]["reembolso_valor_no_cubierto"].'",
                            "'.$consulta[$i]["reembolso_valor_copago"].'",
                            "'.$consulta[$i]["reembolso_valor_reembolsado"].'",
                            "'.$consulta[$i]["reembolso_saldo_deducible"].'",
                            
                            "'.$btnDocumentoLiquidacion.'"
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
$listaProspecto -> mostrar_lista_reembolso_cliente();
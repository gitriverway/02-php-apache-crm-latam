<?php
    require '../../model/modelo_credito_ambulatorio_cliente_empresarial.php';

    class Lista_credito_ambulatorio_cliente{

        function mostrar_lista_credito_ambulatorio_cliente(){

            session_start();

            $idUsuario = $_SESSION['S_IDUSUARIO'];

            // 1	VIDA INDIVIDUAL
            // 2	VIDA COLECTIVA
            // 3	ASISTENCIA MEDICA INDIVIDUAL
            // 4	VEHICULOS
            // 5	ACCIDENTES PERSONALES
            // 6	SEGURO DE VIAJES

            $idCategoria = "5";

            $MU = new Modelo_Credito_Ambulatorio_Cliente_Empresarial();

            $consulta = $MU->listar_credito_ambulatorio_cliente_asistencia_medica($idUsuario,$idCategoria);            

            if(!$consulta){

                echo '{"data": []}';

            }else{

                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        $credito_ambulatorio_descripcion = $consulta[$i]["credito_ambulatorio_descripcion"];

                        $paciente = "";
                        $diagnostico = "";
                        $valor = "";

                        if ($credito_ambulatorio_descripcion != "") {
                            $lista = json_decode($credito_ambulatorio_descripcion, true);

                            foreach ($lista as $value) {
                                $paciente.= $value["nombre_paciente"];
                                $diagnostico .= $value["diagnostico"];
                                $valor .= $value["valor_presentado"];
                            }
                        }
                        
                        
                        $btnObservaciones = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerObservaciones btn btn-primary' idCreditoAmbulatorio = '".$consulta[$i]["credito_ambulatorio_id"]."'><i class='fa fa-search'></i></button></div>";

                        switch ($consulta[$i]["credito_ambulatorio_estatus"]) {
                            case 'PENDIENTE':
                                $estado = "<button class='btn btn-xs btn-warning'>".$consulta[$i]["credito_ambulatorio_estatus"]."</button>";
                                break;
                            case 'PROCESO':
                                $estado = "<button class='btn btn-xs btn-primary'>".$consulta[$i]["credito_ambulatorio_estatus"]."</button>";
                                break;
                            case 'ANULADO':
                                $estado = "<button class='btn btn-xs btn-danger'>".$consulta[$i]["credito_ambulatorio_estatus"]."</button>";
                                break;
                            case 'FINALIZADO':
                                $estado = "<button class='btn btn-xs btn-success'>".$consulta[$i]["credito_ambulatorio_estatus"]."</button>";
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

                        if ($consulta[$i]["DOCUMENTO_AUTORIZACION"] != "") {
                            $btnDocumentoAutorizacion = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumentoAutorizacion btn btn-primary' ruta='".$consulta[$i]["DOCUMENTO_AUTORIZACION"]."'><i class='fas fa-file-pdf'></i></button></div>";
                        } else {
                            $btnDocumentoAutorizacion = "";
                        }
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["credito_ambulatorio_id"].'",
                            "'.$paciente.'",
                            "'.$diagnostico.'",
                            "'.$consulta[$i]["credito_ambulatorio_fecha_registro"].'",
                            "'.$valor.'",
                            "'.$estado.'",
                            "'.$btnDocumento.'",
                            "'.$btnObservaciones.'",
                            "'.$consulta[$i]["credito_ambulatorio_fecha_modificado"].'",
                            "'.$btnDocumentoAutorizacion.'"
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
LISTA TABLA DE OPERATORIO
=============================================*/
$listaProspecto = new Lista_credito_ambulatorio_cliente();
$listaProspecto -> mostrar_lista_credito_ambulatorio_cliente();
<?php
    require '../../model/modelo_contrato_cliente_documento_empresarial.php';

    class Lista_contrato_cliente_documento{

        function mostrar_lista_contrato_cliente_documento(){

            session_start();

            $idCliente = $_GET["idCliente"];

            // $idCliente = "19";

            $MU = new Modelo_Contrato_Cliente_Documento_Empresarial();

            $consulta = $MU->listar_contrato_cliente_documento($idCliente);            

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){
                        if ($consulta[$i]["contrato_estado"] == "ACTIVO") {
                            $estado = "<button class='btn btn-xs btn-success' estado='" . $consulta[$i]["contrato_estado"] . "'>".$consulta[$i]["contrato_estado"]."</button>";
                        } else {
                            $estado = "<button class='btn btn-xs btn-danger' estado='" . $consulta[$i]["contrato_estado"] . "'>".$consulta[$i]["contrato_estado"]."</button>";
                        }

                        if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE") {
                            $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnImprimirDocumento btn btn-success' documentoRuta='" . $consulta[$i]["contrato_ruta_documento"] . "'><i class='fa fa-print'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnEliminarDocumentoEmision btn btn-danger' idCliente='" . $consulta[$i]["bayer_id"] . "' idDocumentoEmision='" . $consulta[$i]["contrato_documento_id"] . "' carpetaDocumento='" . $consulta[$i]["contrato_carpeta_documento"] . "' documentoRuta='" . $consulta[$i]["contrato_ruta_documento"] . "'><i class='fa fa-times'></i></button></div>";
                        }else {
                            $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnImprimirDocumento btn btn-success' documentoRuta='" . $consulta[$i]["contrato_ruta_documento"] . "'><i class='fa fa-print'></i></button></div>";
                        }

                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["contrato_nombre_documento"].'",
                            "'.$consulta[$i]["contrato_fecha_registro"].'",
                            "'.$estado.'",
                            "'.$botones.'"
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
LISTA TABLA DE DOCUMENTOS
=============================================*/
$listaContratoDocumento = new Lista_contrato_cliente_documento();
$listaContratoDocumento -> mostrar_lista_contrato_cliente_documento();
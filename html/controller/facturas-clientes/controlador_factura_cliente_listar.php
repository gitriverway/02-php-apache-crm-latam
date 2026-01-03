<?php
    require '../../model/modelo_factura_cliente.php';

    class Lista_factura_cliente{

        function mostrar_lista_factura_cliente(){

            session_start();

            $idUsuario = $_SESSION['S_IDUSUARIO'];

            $MU = new Modelo_Factura_Cliente();

            $consulta = $MU->listar_factura_cliente_cedula($idUsuario);            

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){
                        if ($consulta[$i]["factura_estatus"] == "EMITIDA" || $consulta[$i]["factura_estatus"] == "PENDIENTE") {
                            $estado_bayer = "<button class='btn btn-xs btn-warning' idFacturaCliente='" . $consulta[$i]["factura_id"] . "' estadoBayer='" . $consulta[$i]["factura_estatus"] . "'>".$consulta[$i]["factura_estatus"]."</button>";
                        } elseif ($consulta[$i]["factura_estatus"] == "PAGADA") {
                            $estado_bayer = "<button class='btn btn-xs btn-success' idFacturaCliente='" . $consulta[$i]["factura_id"] . "' estadoBayer='" . $consulta[$i]["factura_estatus"] . "'>".$consulta[$i]["factura_estatus"]."</button>";
                        }elseif ($consulta[$i]["factura_estatus"] == "ANULADO") {
                            $estado_bayer = "<button class='btn btn-xs btn-danger' idFacturaCliente='" . $consulta[$i]["factura_id"] . "' estadoBayer='" . $consulta[$i]["factura_estatus"] . "'>".$consulta[$i]["factura_estatus"]."</button>";
                        }

                        if ($_SESSION['S_ROL'] == "CLIENTE") {
                            $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnImprimirFacturaCliente btn btn-success' facturaRuta='" . $consulta[$i]["factura_documento"] . "'><i class='fa fa-print'></i></button></div>";
                        } else {
                            if ($consulta[$i]["factura_estatus"] == "PAGADA" || $consulta[$i]["factura_estatus"] == "PENDIENTE") {
                                $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnImprimirFacturaCliente btn btn-success' facturaRuta='" . $consulta[$i]["factura_documento"] . "'><i class='fa fa-print'></i></button></div>";
                            }else {
                                $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnImprimirFacturaCliente btn btn-success' facturaRuta='" . $consulta[$i]["factura_documento"] . "'><i class='fa fa-print'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnEliminarFacturaCliente btn btn-danger' idFactura='" . $consulta[$i]["factura_id"] . "' facturaRuta='" . $consulta[$i]["factura_documento"] . "'><i class='fa fa-times'></i></button></div>";
                            }
                        }
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["factura_cedula"].'",
                            "'.$consulta[$i]["factura_nombre"].'",
                            "'.$consulta[$i]["factura_numero"].'",
                            "'.$consulta[$i]["factura_fecha_emision"].'",
                            "'.$consulta[$i]["factura_valor"].'",
                            "'.$consulta[$i]["factura_saldo"].'",
                            "'.$estado_bayer.'",
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
LISTA TABLA DE PROSPECTO
=============================================*/
$listaProspecto = new Lista_factura_cliente();
$listaProspecto -> mostrar_lista_factura_cliente();
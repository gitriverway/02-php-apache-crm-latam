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

            $idCategoria = "1";

            $MU = new Modelo_Reembolso_Cliente_Empresarial();

            $consulta = $MU->listar_reembolso_cliente_vida($idUsuario,$idCategoria);            

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){
                        switch ($consulta[$i]["reembolso_estatus"]) {
                            case 'PENDIENTE':
                                $estado = "<button class='btn btn-xs btn-warning'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                            case 'ANULADO':
                                $estado = "<button class='btn btn-xs btn-danger'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                            case 'APROBADO':
                                $estado = "<button class='btn btn-xs btn-success'>".$consulta[$i]["reembolso_estatus"]."</button>";
                                break;
                            default:
                                # code...
                                break;
                        }

                            $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerReembolsoCliente btn btn-primary' idReembolso='" . $consulta[$i]["reembolso_id"] . "'><i class='fa fa-eye'></i></button></div>";
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["cliente_nombre"].'",
                            "'.$consulta[$i]["contrato_numero"].'",
                            "'.$consulta[$i]["reembolso_fecha_registro"].'",
                            "'.$consulta[$i]["reembolso_fecha_modificado"].'",
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
LISTA TABLA DE PROSPECTO
=============================================*/
$listaProspecto = new Lista_reembolso_cliente();
$listaProspecto -> mostrar_lista_reembolso_cliente();
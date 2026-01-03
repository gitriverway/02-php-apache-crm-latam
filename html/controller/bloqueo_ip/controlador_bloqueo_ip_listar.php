<?php
    require '../../model/modelo_bloqueo_ip.php';

    class Lista_bloqueo_ip{

        function mostrar_lista_bloqueo_ip(){


            $MU = new Modelo_Bloqueo_Ip();

            $consulta = $MU->listar_bloqueo_ip();

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){
                        
                        if ($consulta[$i]["bloqueo_estatus"] == "NO") {
                            $estado_bayer = "<button class='btn btn-xs btn-success btnEstadoBloqueoIp' idBloqueoIp='" . $consulta[$i]["bloqueo_id"] . "' estadoBloqueo='SI'>HABILITADO</button>";
                        }else {
                            $estado_bayer = "<button class='btn btn-xs btn-danger btnEstadoBloqueoIp' idBloqueoIp='" . $consulta[$i]["bloqueo_id"] . "' estadoBloqueo='NO'>BLOQUEADO</button>";
                        }

                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$estado_bayer.'",
                            "'.$consulta[$i]["bloqueo_ip"].'",
                            "'.$consulta[$i]["contador"].'",
                            "'.$consulta[$i]["bloqueo_descripcion"].'"
                            
                            
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
LISTA TABLA DE BLOQUEO IP
=============================================*/
$listaBloqueoIp = new Lista_bloqueo_ip();
$listaBloqueoIp -> mostrar_lista_bloqueo_ip();
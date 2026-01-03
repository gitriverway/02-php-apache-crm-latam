<?php
    require '../../model/modelo_cliente.php';

    class Lista_clientes{

        function mostrar_lista_clientes(){

            session_start();

            $idUsuario = $_SESSION['S_IDUSUARIO'];

            $MU = new Modelo_Cliente();

            $consulta = $MU->listar_clientes();
            

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        if ($consulta[$i]["cliente_email"] != "") {
                            $enviar_acceso =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnEnviarAcceso btn btn-warning' idCliente='" . $consulta[$i]["cliente_id"] . "'><i class='fa fa-envelope'></i></button></div>";
                        } else {
                            $enviar_acceso =  "";
                        }

                        if ($consulta[$i]["cliente_ci"] != "") {
                            $resetear_clave =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnResetClave btn btn-success' idCliente='" . $consulta[$i]["cliente_id"] . "' cedula = '".$consulta[$i]["cliente_ci"]."'><i class='fa fa-key'></i></button></div>";
                        } else {
                            $resetear_clave =  "";
                        }

                        $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnEditarCliente btn btn-primary' idCliente='" . $consulta[$i]["cliente_id"] . "'><i class='fa fa-edit'></i></button></div>";
                        
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["cliente_nombre"].'",
                            "'.$consulta[$i]["cliente_ci"].'",
                            "'.$consulta[$i]["cliente_fecha_nacimiento"].'",
                            "'.$consulta[$i]["cliente_genero"].'",
                            "'.$consulta[$i]["cliente_email"].'",
                            "'.$enviar_acceso.'",
                            "'.$resetear_clave.'",
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
LISTAR TABLA CLIENTES
=============================================*/
$listaUsuario = new Lista_clientes();
$listaUsuario -> mostrar_lista_clientes();
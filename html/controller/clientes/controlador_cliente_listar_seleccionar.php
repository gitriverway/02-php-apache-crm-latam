<?php
    require '../../model/modelo_cliente.php';

    class Lista_asignar_cliente_seleccionar{

        function mostrar_lista_asignar_cliente_seleccionar(){

            $MU = new Modelo_Cliente();

            $consulta = $MU->listar_cliente_seleccionar();
            

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeleccionarCliente btn btn-success' idCliente='" . $consulta[$i]["cliente_id"] . "'><i class='fa fa-eye'></i></button></div>";
                              
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["cliente_nombre"].'",
                            "'.$consulta[$i]["cliente_ci"].'",
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
LISTA DE CLIENTES PARA SELECCIONAR
=============================================*/
$listaClientes = new Lista_asignar_cliente_seleccionar();
$listaClientes -> mostrar_lista_asignar_cliente_seleccionar();
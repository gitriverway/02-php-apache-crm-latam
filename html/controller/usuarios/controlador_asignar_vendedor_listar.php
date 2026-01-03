<?php
    require '../../model/modelo_usuario.php';

    class Lista_asignar_vendedor{

        function mostrar_lista_asignar_vendedor(){

            $MU = new Modelo_Usuario();

            $consulta = $MU->listar_asignar_vendedor();

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){
                        
                        $botones =  "<button style='font-size:13px;' type='button' class='btnAsignarVendedor btn btn-primary' idEmpleado='" . $consulta[$i]["empleado_id"] . "'><i class='fa fa-edit'></i></button>";
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["empleado_nombre"].'",
                            "'.$consulta[$i]["rol_nombre"].'",
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUsuario = new Lista_asignar_vendedor();
$listaUsuario -> mostrar_lista_asignar_vendedor();
<?php
    require '../../model/modelo_usuario.php';

    class Lista_usuario{

        function mostrar_lista_usuario(){

            $MU = new Modelo_Usuario();

            $consulta = $MU->listar_usuario();

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        if ($consulta[$i]["usuario_imagen"] != "") {
                            $imagen = "<img src='".$consulta[$i]["usuario_imagen"]."' width='40px'>";
                        }else{
                            $imagen = "<img src='view/img/usuarios/anonymous.png' width='40px'>";
                        }

                        if ($consulta[$i]["empleado_nombre"] != "") {
                            $empleado = $consulta[$i]["empleado_nombre"];
                        }else{
                            $empleado = "";
                        }

                        if ($consulta[$i]["usuario_estatus"]=='ACTIVO') {
                            $estado = "<button class='btn btn-success btn-xs btnActivar' idUsuario='" . $consulta[$i]["usuario_id"] . "' estadoUsuario='INACTIVO'>".$consulta[$i]["usuario_estatus"]."</button>";
                        } else {
                            $estado = "<button class='btn btn-danger btn-xs btnActivar' idUsuario='" . $consulta[$i]["usuario_id"] . "' estadoUsuario='ACTIVO'>".$consulta[$i]["usuario_estatus"]."</button>";
                        }
                        
                        $botones =  "<button style='font-size:13px;' type='button' class='btnEditar btn btn-primary' idUsuario='" . $consulta[$i]["usuario_id"] . "'><i class='fa fa-edit'></i></button>";
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$imagen.'",
                            "'.$consulta[$i]["usuario_nombre"].'",
                            "'.$consulta[$i]["rol_nombre"].'",
                            "'.$empleado.'",
                            "'.$estado.'",
                            "'.$botones.'"
                    ],';

                    }
                    
                $datosJson = substr($datosJson, 0, -1);

                $datosJson .=   ']

                }';
                echo $datosJson;
            }

            // echo json_encode($consulta);

        }

    }


/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$listaUsuario = new Lista_usuario();
$listaUsuario -> mostrar_lista_usuario();
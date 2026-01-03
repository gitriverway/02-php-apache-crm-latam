<?php
    require '../../model/modelo_empleado.php';

    class Lista_empleado{

        function mostrar_lista_empleado(){

            $MU = new Modelo_Empleado();

            $consulta = $MU->listar_empleado();

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                            if ($consulta[$i]["empleado_estatus"]=='ACTIVO') {
                                $estado = "<button class='btn btn-success btn-xs btnActivar' idEmpleado='" . $consulta[$i]["empleado_id"] . "' estadoEmpleado='INACTIVO'>".$consulta[$i]["empleado_estatus"]."</button>";
                            } else {
                                $estado = "<button class='btn btn-danger btn-xs btnActivar' idEmpleado='" . $consulta[$i]["empleado_id"] . "' estadoEmpleado='ACTIVO'>".$consulta[$i]["empleado_estatus"]."</button>";
                            }
                        

                            $botones =  "<button style='font-size:13px;' type='button' class='btnEditar btn btn-primary' idEmpleado='" . $consulta[$i]["empleado_id"] . "'><i class='fa fa-edit'></i></button>";
                        
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["empleado_nombre"].'",
                            "'.$consulta[$i]["empleado_direccion"].'",
                            "'.$consulta[$i]["provincia_descripcion"].'",
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
$listaProspecto = new Lista_empleado();
$listaProspecto -> mostrar_lista_empleado();
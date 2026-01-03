<?php
    require '../../model/modelo_proveedor.php';

    class Lista_plan_proveedor{

        function mostrar_lista_plan_proveedor(){

            $idProveedor = htmlspecialchars($_GET['idProveedor'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Proveedor();

           $consulta = $MU->listar_planes_por_proveedor($idProveedor);

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                            $botones =  "<button style='font-size:13px;' class='btnAsignarProducto btn btn-primary' descripcionProducto='".$consulta[$i]["plan_descripcion"]."' idProducto='" . $consulta[$i]["producto_id"] . "'><i class='fa fa-check'></i></button>";
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["proveedor_descripcion"].'",
                            "'.$consulta[$i]["plan_descripcion"].'",
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
$listaUsuario = new Lista_plan_proveedor();
$listaUsuario -> mostrar_lista_plan_proveedor();
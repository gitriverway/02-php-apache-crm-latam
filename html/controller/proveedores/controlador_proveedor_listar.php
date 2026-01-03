<?php
    require '../../model/modelo_proveedor.php';

    class Lista_proveedor{

        function mostrar_lista_proveedor(){

            $MU = new Modelo_Proveedor();

            $consulta = $MU->listar_proveedor();

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        if ($consulta[$i]["proveedor_correo_reembolsos"] != "") {
                            $lista_correo_reembolso = json_decode($consulta[$i]["proveedor_correo_reembolsos"],true);
                        }else{
                            $lista_correo_reembolso = "";
                        }
                        if ($consulta[$i]["proveedor_correo_siniestros"] != "") {
                            $lista_correo_siniestro = json_decode($consulta[$i]["proveedor_correo_siniestros"],true);
                        } else {
                            $lista_correo_siniestro = "";
                        }

                        if ($consulta[$i]["proveedor_correo_operatorios"]) {
                            $lista_correo_operatorio = json_decode($consulta[$i]["proveedor_correo_operatorios"],true);
                        } else {
                            $lista_correo_operatorio = "";
                        }
                        
                        if ($consulta[$i]["proveedor_correo_creditos_ambulatorios"] != "") {
                            $lista_correo_credito_ambulatorio = json_decode($consulta[$i]["proveedor_correo_creditos_ambulatorios"],true);
                        } else {
                            $lista_correo_credito_ambulatorio = "";
                        }

                        if ($consulta[$i]["proveedor_correo_siniestros_hogar"] != "") {
                            $lista_correo_siniestro_hogar = json_decode($consulta[$i]["proveedor_correo_siniestros_hogar"],true);
                        } else {
                            $lista_correo_siniestro_hogar = "";
                        }

                        $correo_reembolso = "";
                        $correo_siniestro = "";
                        $correo_operatorio = "";
                        $correo_credito_ambulatorio = "";
                        $correo_siniestro_hogar = "";

                        foreach ($lista_correo_reembolso as $value) {
                            $correo_reembolso .= "<p>".$value["correo"]."</p>";
                        }
                        foreach ($lista_correo_siniestro as $value) {
                            $correo_siniestro .= "<p>".$value["correo"]."</p>";
                        }
                        foreach ($lista_correo_operatorio as $value) {
                            $correo_operatorio .= "<p>".$value["correo"]."</p>";
                        }
                        foreach ($lista_correo_credito_ambulatorio as $value) {
                            $correo_credito_ambulatorio .= "<p>".$value["correo"]."</p>";
                        }
                        foreach ($lista_correo_siniestro_hogar as $value) {
                            $correo_siniestro_hogar .= "<p>".$value["correo"]."</p>";
                        }


                            if ($consulta[$i]["proveedor_estatus"]=='ACTIVO') {
                                $estado = "<button class='btn btn-success btn-xs btnActivar'>".$consulta[$i]["proveedor_estatus"]."</button>";
                            } else {
                                $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$consulta[$i]["proveedor_estatus"]."</button>";
                            }
                        

                            $botones =  "<button style='font-size:13px;' type='button' class='btnEditar btn btn-primary' idProveedor='" . $consulta[$i]["proveedor_id"] . "'><i class='fa fa-edit'></i></button>";
                        
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["proveedor_descripcion"].'",
                            "'.$correo_reembolso.'",
                            "'.$correo_siniestro.'",
                            "'.$correo_operatorio.'",
                            "'.$correo_credito_ambulatorio.'",
                            "'.$correo_siniestro_hogar.'",
                            "'.$consulta[$i]["proveedor_fecha_registro"].'",
                            "'.$consulta[$i]["proveedor_fecha_modificacion"].'",
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
$listaProspecto = new Lista_proveedor();
$listaProspecto -> mostrar_lista_proveedor();
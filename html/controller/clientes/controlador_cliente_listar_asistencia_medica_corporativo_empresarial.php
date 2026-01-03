<?php
    require '../../model/modelo_bayer_persona_empresarial.php';

    class Lista_asignar_cliente{

        function mostrar_lista_asignar_cliente(){

            session_start();

            $idUsuario = $_SESSION['S_IDUSUARIO'];

            $MU = new Modelo_Bayer_Persona_Empresarial();

            // 1	VIDA INDIVIDUAL
            // 2	VIDA COLECTIVA
            // 3	ASISTENCIA MEDICA INDIVIDUAL
            // 4	VEHICULOS
            // 5	ACCIDENTES PERSONALES
            // 6	SEGURO DE VIAJES

            $idCategoria = "6";

            if ($_SESSION['S_ROL'] != "VENDEDOR") {    
                $consulta = $MU->listar_cliente_vida_individual($idCategoria);
            } else {
                $consulta = $MU->listar_cliente_vida_individual_asignados($idUsuario,$idCategoria);
            }

            if(!$consulta){

                echo '{"data": []}';

            }else{
                $datosJson = '{
                    "data": [';
                    for($i = 0; $i < count($consulta); $i++){

                        $dependientes = $consulta[$i]["cliente_familiares"];
                        $vehiculos = $consulta[$i]["cliente_vehiculos"];

                        $dependiente = "";

                        if ($dependientes != "") {
                            
                            $dependiente .= '<p>Colaboradores</p>';

                            $lista = json_decode($dependientes, true);

                            foreach ($lista as $value) {
                                $dependiente .= '<p>'.$value["genero"].' '.$value["edad"] .' años</p>';
                            }
                        }

                        if ($vehiculos != "") {
                            $lista1 = json_decode($vehiculos, true);

                            $dependiente .= '<p>Vehiculos</p>';

                            foreach ($lista1 as $value) {
                                $dependiente .= '<p>Tipo: '.$value["tipo"].'</p>';
                                $dependiente .= '<p>Marca: '.$value["marca"].'</p>';
                                $dependiente .= '<p>Modelo: '.$value["modelo"].'</p>';
                                $dependiente .= '<p>Año: '.$value["ano"].'</p>';
                                $dependiente .= '<p>Monto: '.$value["monto"].'</p>';
                            }
                        }

                        if ($consulta[$i]["proveedor_descripcion"] == "") {
                            $proveedor_descripcion ="";
                        } else {
                            $proveedor_descripcion =$consulta[$i]["proveedor_descripcion"]."/".$consulta[$i]["producto_id"];
                        }
                        
                        if ($_SESSION['S_ROL'] == "VENDEDOR") {
                            $empleado = "<button class='btn btn-warning btn-xs' idCliente='" . $consulta[$i]["bayer_id"] . "'>".$consulta[$i]["empleado_nombre"]."</button>";
                        }else {
                            $empleado = "<button class='btn btn-warning btn-xs btnListaVendedor' idCliente='" . $consulta[$i]["bayer_id"] . "'>".$consulta[$i]["empleado_nombre"]."</button>";
                        }
                        
                        if ($consulta[$i]["cliente_estado_bayer"] == "CONTRATADO") {
                            if ($consulta[$i]["contrato_numero"] == "") {
                                $estado_bayer = "<button class='btn btn-xs btn-warning'>NUEVO ".$consulta[$i]["cliente_estado_bayer"]."</button>";
                            } else {
                                $estado_bayer = "<button class='btn btn-xs btn-success'>".$consulta[$i]["cliente_estado_bayer"]."</button>";
                            }
                        }else {
                            $estado_bayer = "<button class='btn btn-xs btn-danger'>".$consulta[$i]["cliente_estado_bayer"]."</button>";
                        }
                        
                            $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnListaContratos btn btn-success' idCliente='" . $consulta[$i]["bayer_id"] . "'><i class='fa fa-eye'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnBayerPersona btn btn-primary' idCliente='" . $consulta[$i]["bayer_id"] . "'><i class='fa fa-edit'></i></button></div>";
                        
                        
                        $datosJson .='[
                            "'.$consulta[$i]["posicion"].'",
                            "'.$consulta[$i]["cliente_origen"].'",
                            "'.$botones.'",
                            "'.$estado_bayer.'",
                            "'.$consulta[$i]["contrato_fecha_inicio"].'",
                            "'.$consulta[$i]["contrato_fecha_fin"].'",
                            "'.$consulta[$i]["cliente_nombre"].'",
                            "'.$consulta[$i]["cliente_ci"].'",
                            "'.$consulta[$i]["provincia_descripcion"].'",
                            "'.$consulta[$i]["cliente_telefono"].'",
                            "'.$proveedor_descripcion.'",
                            "'.$empleado.'",
                            "'.$consulta[$i]["cliente_fecha_seguimiento"].'"                            
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
$listaUsuario = new Lista_asignar_cliente();
$listaUsuario -> mostrar_lista_asignar_cliente();
<?php
require '../../model/modelo_prospecto_web.php';

class Lista_prospecto_web
{

    function mostrar_lista_prospecto_web()
    {

        session_start();

        $MU = new Modelo_Prospecto_Web();

        $consulta = $MU->listar_prospecto_web();

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {

                $dependientes = $consulta[$i]["prospecto_web_familiares"];
                $vehiculos = $consulta[$i]["prospecto_web_vehiculos"];
                $chats = $consulta[$i]["prospecto_web_chat"];

                $dependiente = "";

                if ($dependientes != "") {
                    $lista = json_decode($dependientes, true);

                    $dependiente .= '<p>Dependientes</p>';

                    foreach ($lista as $value) {

                        $genero = isset($value["genero"]) ? $value["genero"] : "";
                        $edad = isset($value["edad"]) ? $value["edad"] . " años" : "";

                        $dependiente .= '<p>' . $genero . ' ' . $edad . '</p>';
                    }
                }
                if ($vehiculos != "") {
                    $lista1 = json_decode($vehiculos, true);

                    $dependiente .= '<p>Vehiculos</p>';

                    foreach ($lista1 as $value) {

                        $tipo = isset($value["tipo"]) ? '<p>Tipo: ' . $value["tipo"] . '&nbsp</p>' : "";
                        $placa = isset($value["placa"]) ? '<p>Placa: ' . $value["placa"] . '&nbsp</p>' : "";
                        $marca = isset($value["marca"]) ? '<p>Marca: ' . $value["marca"] . '&nbsp</p>' : "";
                        $modelo = isset($value["modelo"]) ? '<p>Modelo: ' . $value["modelo"] . '&nbsp</p>' : "";
                        $color = isset($value["color"]) ? '<p>Color: ' . $value["color"] . '&nbsp</p>' : "";
                        $ano = isset($value["ano"]) ? '<p>Año: ' . $value["ano"] . '&nbsp</p>' : "";
                        $monto = isset($value["monto"]) ? '<p>Monto: ' . $value["monto"] . '&nbsp</p>' : "";
                        $cliente_edad = isset($consulta[$i]["cliente_edad"]) ? '<p>Edad: ' . $consulta[$i]["cliente_edad"] . '&nbsp</p>' : "";

                        $estado_civil = isset($consulta[$i]["cliente_estado_civil"]) ? '<p>Estado Civil: ' . strtoupper($consulta[$i]["cliente_estado_civil"]) . '&nbsp</p>' : "";

                        $genero = isset($value["genero"]) ? '<p>Género: ' . strtoupper($value["genero"]) . '&nbsp</p>' : "";

                        $dependiente .= $tipo . $placa  . $marca . $modelo  . $color . $ano . $monto . $cliente_edad . $estado_civil . $genero;
                    }
                }

                if ($chats != "") {
                    $btnchat = "<button style='font-size:13px;' class='btn btn-primary btnChatWeb' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "'><i class='fa fa-search'></i></button>";
                } else {
                    $btnchat = "";
                }


                if ($_SESSION['S_ROL'] == "VENDEDOR") {
                    $empleado = "<button class='btn btn-warning btn-xs' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "'>" . $consulta[$i]["empleado_nombre"] . "</button>";
                } else {
                    $empleado = "<button class='btn btn-warning btn-xs' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "'>" . $consulta[$i]["empleado_nombre"] . "</button>";
                }

                if ($consulta[$i]["prospecto_web_estatus"] != "CONTRATADO") {
                    $estado_bayer = "<button class='btn btn-xs btnEstadoBayer' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "' estadoBayer='" . $consulta[$i]["prospecto_web_estado_bayer"] . "'>" . $consulta[$i]["prospecto_web_estado_bayer"] . "</button>";
                } else {
                    $estado_bayer = "<button class='btn btn-xs' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "' estadoBayer='" . $consulta[$i]["prospecto_web_estado_bayer"] . "'>" . $consulta[$i]["prospecto_web_estado_bayer"] . "</button>";
                }

                $botones =  "<button style='font-size:13px;' type='button' class='btnEliminarProspectoWeb btn btn-danger' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "'><i class='fa fa-times'></i></button>";


                $check =  "<div class='form-check'><input class='form-check-input chkSeleccionarAsignar' id='chkSeleccionarAsignar' name='chkSeleccionarAsignar' type='checkbox' idProspecto='" . $consulta[$i]["prospecto_web_id"] . "'></div>";

                $origen_web = $consulta[$i]["origen_cotizador"] . "-" . $consulta[$i]["cliente_origen"];
                // $origen_web = $consulta[$i]["cliente_origen"];


                $fecha = new DateTime($consulta[$i]["prospecto_web_fecha_registro"]);

                $anio = $fecha->format("Y");

                $meses = [
                    "January" => "Enero",
                    "February" => "Febrero",
                    "March" => "Marzo",
                    "April" => "Abril",
                    "May" => "Mayo",
                    "June" => "Junio",
                    "July" => "Julio",
                    "August" => "Agosto",
                    "September" => "Septiembre",
                    "October" => "Octubre",
                    "November" => "Noviembre",
                    "December" => "Diciembre"
                ];

                $mesNumero = $fecha->format("m");

                $mesIngles = $fecha->format("F");
                $mesEspanol = $mesNumero  . " " . $meses[$mesIngles];

                $datosJson .= '[
                            "' . $consulta[$i]["posicion"] . '",
                            "' . $botones . '",
                            "' . $check . '",
                            "' . $estado_bayer . '",
                            "' . $empleado . '",
                            "' . $consulta[$i]["cliente_nombre"] . '",
                            "' . $btnchat . '",
                            "' . $consulta[$i]["cliente_ci"] . '",
                            "' . $consulta[$i]["categoria_nombre"] . '",
                            "' . $dependiente . '",
                            "' . $consulta[$i]["provincia_descripcion"] . '",
                            "' . $consulta[$i]["cliente_telefono"] . '",
                            "' . $consulta[$i]["proveedor_descripcion"] . '",
                            "' . $consulta[$i]["producto_id"] . '",
                            "' . $origen_web . '",
                            "' . $anio . '",
                            "' . $mesEspanol . '",
                            "' . $consulta[$i]["prospecto_web_fecha_registro"] . '"
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
$listaProspecto = new Lista_prospecto_web();
$listaProspecto->mostrar_lista_prospecto_web();
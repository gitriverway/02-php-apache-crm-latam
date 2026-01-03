<?php
require '../../model/modelo_bayer_persona_empresarial.php';

class Lista_prospecto
{

    function mostrar_lista_prospecto()
    {

        session_start();

        $MU = new Modelo_Bayer_Persona_Empresarial();

        switch ($_SESSION['S_ROL']) {
            case 'GERENTE':
                $consulta = $MU->listar_prospecto();
                break;
            case 'GERENTE 1':
                $consulta = $MU->listar_prospecto();
                break;
            case 'VENDEDOR':
                $consulta = $MU->listar_prospecto_asignado($_SESSION['S_IDUSUARIO']);
                break;
            default:
                # code...
                break;
        }

        // if ($_SESSION['S_ROL'] != "VENDEDOR") {
        //     $consulta = $MU->listar_prospecto();
        // }else {
        //     $consulta = $MU->listar_prospecto_asignado($_SESSION['S_IDUSUARIO']);
        // }

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {

                $dependientes = $consulta[$i]["cliente_familiares"];
                $vehiculos = $consulta[$i]["cliente_vehiculos"];

                $dependiente = "";

                if ($dependientes != "") {

                    $dependiente .= '<p>Colaboradores</p>';

                    $lista = json_decode($dependientes, true);

                    foreach ($lista as $value) {
                        $dependiente .= '<p>' . $value["genero"] . ' ' . $value["edad"] . ' años</p>';
                    }
                }

                if ($vehiculos != "") {
                    $lista1 = json_decode($vehiculos, true);

                    $dependiente .= '<p>Vehiculos</p>';

                    foreach ($lista1 as $value) {
                        $dependiente .= '<p>Tipo: ' . $value["tipo"] . '</p>';
                        $dependiente .= '<p>Marca: ' . $value["marca"] . '</p>';
                        $dependiente .= '<p>Modelo: ' . $value["modelo"] . '</p>';
                        $dependiente .= '<p>Año: ' . $value["ano"] . '</p>';
                        $dependiente .= '<p>Monto: ' . $value["monto"] . '</p>';
                    }
                }

                if ($_SESSION['S_ROL'] == "VENDEDOR") {
                    $empleado = "<button class='btn btn-warning btn-xs' idProspecto='" . $consulta[$i]["bayer_id"] . "'>" . $consulta[$i]["empleado_nombre"] . "</button>";
                } else {
                    $empleado = "<button class='btn btn-warning btn-xs' idProspecto='" . $consulta[$i]["bayer_id"] . "'>" . $consulta[$i]["empleado_nombre"] . "</button>";
                }

                if ($consulta[$i]["cliente_estado_bayer"] != "CONTRATADO") {
                    $estado_bayer = "<button class='btn btn-xs btnEstadoBayer' idProspecto='" . $consulta[$i]["bayer_id"] . "' estadoBayer='" . $consulta[$i]["cliente_estado_bayer"] . "'>" . $consulta[$i]["cliente_estado_bayer"] . "</button>";
                } else {
                    $estado_bayer = "<button class='btn btn-xs' idProspecto='" . $consulta[$i]["bayer_id"] . "' estadoBayer='" . $consulta[$i]["cliente_estado_bayer"] . "'>" . $consulta[$i]["cliente_estado_bayer"] . "</button>";
                }

                $check =  "<div class='form-check'><input class='form-check-input chkSeleccionarAsignar' id='chkSeleccionarAsignar' name='chkSeleccionarAsignar' type='checkbox' idProspecto='" . $consulta[$i]["bayer_id"] . "'></div>";

                $botones =  "<button style='font-size:13px;' type='button' class='btnBayerPersona btn btn-primary' idProspecto='" . $consulta[$i]["bayer_id"] . "'><i class='fa fa-edit'></i></button>";

                $origen_web = $consulta[$i]["origen_cotizador"] . "-" . $consulta[$i]["cliente_origen"];
                // $origen_web = $consulta[$i]["cliente_origen"];

                $fecha = new DateTime($consulta[$i]["cliente_fecha_registro"]);

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
                            "' . $consulta[$i]["cliente_ci"] . '",
                            "' . $consulta[$i]["cliente_fecha_seguimiento"] . '",
                            "' . $consulta[$i]["categoria_nombre"] . '",
                            "' . $dependiente . '",
                            "' . $consulta[$i]["provincia_descripcion"] . '",
                            "' . $consulta[$i]["cliente_telefono"] . '",
                            "' . $consulta[$i]["proveedor_descripcion"]  . '",
                            "' .  $consulta[$i]["producto_id"] . '",
                            "' . $origen_web . '",
                            "' . $anio . '",
                            "' . $mesEspanol . '",
                            "' . $consulta[$i]["cliente_fecha_registro"] . '"                            
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
$listaProspecto = new Lista_prospecto();
$listaProspecto->mostrar_lista_prospecto();

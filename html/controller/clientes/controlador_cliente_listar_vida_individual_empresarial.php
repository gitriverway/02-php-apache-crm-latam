<?php
require '../../model/modelo_bayer_persona_empresarial.php';
require '../../model/modelo_contrato_cliente.php';

class Lista_asignar_cliente
{

    function mostrar_lista_asignar_cliente()
    {

        session_start();

        $idUsuario = $_SESSION['S_IDUSUARIO'];

        $MU = new Modelo_Bayer_Persona_Empresarial();

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA PYMES
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "2";

        switch ($_SESSION['S_ROL']) {
            case 'VENDEDOR':
                $consulta = $MU->listar_cliente_vida_individual_asignados($idUsuario, $idCategoria);
                break;
            default:
                $consulta = $MU->listar_cliente_vida_individual($idCategoria);
                break;
        }

        // if ($_SESSION['S_ROL'] != "VENDEDOR") {    
        //     $consulta = $MU->listar_cliente_vida_individual($idCategoria);
        // } else {
        //     $consulta = $MU->listar_cliente_vida_individual_asignados($idUsuario,$idCategoria);
        // }

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {


                $MCO = new Modelo_Contrato_Cliente();
                $consultaContrato = $MCO->listar_contrato_cliente_bayerpersona($consulta[$i]["bayer_id"]);

                $fecha = "";

                for ($j = 0; $j < 1; $j++) {
                    $fecha = new DateTime($consultaContrato[$j]["contrato_fecha_inicio"]);
                }

                // $dependientes = $consulta[$i]["cliente_familiares"];
                // $vehiculos = $consulta[$i]["cliente_vehiculos"];

                // $dependiente = "";

                // if ($dependientes != "") {

                //     $dependiente .= '<p>Colaboradores</p>';

                //     $lista = json_decode($dependientes, true);

                //     foreach ($lista as $value) {
                //         $dependiente .= '<p>'.$value["genero"].' '.$value["edad"] .' años</p>';
                //     }
                // }

                // if ($vehiculos != "") {
                //     $lista1 = json_decode($vehiculos, true);

                //     $dependiente .= '<p>Vehiculos</p>';

                //     foreach ($lista1 as $value) {
                //         $dependiente .= '<p>Tipo: '.$value["tipo"].'</p>';
                //         $dependiente .= '<p>Marca: '.$value["marca"].'</p>';
                //         $dependiente .= '<p>Modelo: '.$value["modelo"].'</p>';
                //         $dependiente .= '<p>Año: '.$value["ano"].'</p>';
                //         $dependiente .= '<p>Monto: '.$value["monto"].'</p>';
                //     }
                // }

                if ($_SESSION['S_ROL'] == "VENDEDOR") {
                    $empleado = "<button class='btn btn-warning btn-xs' idCliente='" . $consulta[$i]["bayer_id"] . "'>" . $consulta[$i]["empleado_nombre"] . "</button>";
                } else {
                    $empleado = "<button class='btn btn-warning btn-xs btnListaVendedor' idCliente='" . $consulta[$i]["bayer_id"] . "'>" . $consulta[$i]["empleado_nombre"] . "</button>";
                }

                if ($consulta[$i]["cliente_estado_bayer"] == "CONTRATADO") {
                    if ($consulta[$i]["contrato_numero"] == "") {
                        $estado_bayer = "<button class='btn btn-xs btn-warning'>NUEVO " . $consulta[$i]["cliente_estado_bayer"] . "</button>";
                    } else {
                        $estado_bayer = "<button class='btn btn-xs btn-success'>" . $consulta[$i]["cliente_estado_bayer"] . "</button>";
                    }
                } else {
                    $estado_bayer = "<button class='btn btn-xs btn-danger'>" . $consulta[$i]["cliente_estado_bayer"] . "</button>";
                }

                $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnListaContratos btn btn-success' idCliente='" . $consulta[$i]["bayer_id"] . "'><i class='fa fa-eye'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='btnBayerPersona btn btn-primary' idCliente='" . $consulta[$i]["bayer_id"] . "'><i class='fa fa-edit'></i></button></div>";


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
                            "' . $consulta[$i]["cliente_origen"] . '",
                            "' . $botones . '",
                            "' . $estado_bayer . '",
                            "' . $consulta[$i]["contrato_fecha_inicio"] . '",
                            "' . $consulta[$i]["contrato_fecha_fin"] . '",
                            "' . $consulta[$i]["cliente_nombre"] . '",
                            "' . $consulta[$i]["cliente_ci"] . '",
                            "' . $consulta[$i]["provincia_descripcion"] . '",
                            "' . $consulta[$i]["ciudad_id"] . '",
                            "' . $consulta[$i]["cliente_telefono"] . '",
                            "' . $consulta[$i]["cliente_email"] . '",
                            "' . $consulta[$i]["proveedor_descripcion"] . '",
                            "' . $consulta[$i]["producto_id"] . '",
                            "' . $empleado . '",
                            "' . $consulta[$i]["cliente_fecha_seguimiento"] . '",
                            "' . $consulta[$i]["cliente_ocupacion"] . '",
                            "' . $consulta[$i]["cliente_ingreso"] . '",
                            "' . $consulta[$i]["cliente_valor_asegurado"] . '",
                            "' . $consulta[$i]["cliente_prima_neta"] . '",
                            "' . $consulta[$i]["cliente_prima_comisionable"] . '",
                            "' . $consulta[$i]["cliente_prima_total"] . '",
                            "' . $consulta[$i]["cliente_tipo_pago"] . '",
                            "' . $consulta[$i]["cliente_forma_pago"] . '",
                            "' . $anio . '",
                            "' . $mesEspanol . '"
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
$listaUsuario->mostrar_lista_asignar_cliente();

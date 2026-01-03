<?php
require '../../model/modelo_empleado.php';

class Lista_asignar_empleado_seleccionar
{

    function mostrar_lista_asignar_empleado_seleccionar()
    {

        $MU = new Modelo_Empleado();

        $consulta = $MU->listar_empleados_seleccionar();


        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {

                $botones =  "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnSeleccionarEmpleado btn btn-success' idEmpleado='" . $consulta[$i]["empleado_id"] . "'><i class='fa fa-eye'></i></button></div>";

                $datosJson .= '[
                            "' . $consulta[$i]["posicion"] . '",
                            "' . $consulta[$i]["empleado_nombre"] . '",
                            "' . $botones . '"
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
$listaClientes = new Lista_asignar_empleado_seleccionar();
$listaClientes->mostrar_lista_asignar_empleado_seleccionar();
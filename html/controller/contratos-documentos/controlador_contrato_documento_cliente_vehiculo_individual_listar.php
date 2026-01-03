<?php
require '../../model/modelo_contrato_cliente.php';

class Lista_contrato_documento_cliente
{

    function mostrar_lista_contrato_documento_cliente()
    {

        session_start();

        $idUsuario = $_SESSION['S_IDUSUARIO'];

        // 1	VIDA INDIVIDUAL
        // 2	VIDA COLECTIVA
        // 3	ASISTENCIA MEDICA INDIVIDUAL
        // 4	VEHICULOS
        // 5	ACCIDENTES PERSONALES
        // 6	SEGURO DE VIAJES

        $idCategoria = "4";

        $estado = "ACTIVO";

        $MU = new Modelo_Contrato_Cliente();
        $consulta = $MU->listar_contrato_cliente($idUsuario, $idCategoria, $estado);

        if (!$consulta) {

            echo '{"data": []}';
        } else {
            $datosJson = '{
                    "data": [';
            for ($i = 0; $i < count($consulta); $i++) {

                if ($consulta[$i]["REPORTE DE SINIESTRO"] != "") {
                    $btnReporteSiniestro = "<div class='btn-group'><button style='font-size:13px;' type='button' class='btnVerDocumento btn btn-primary' ruta='" . $consulta[$i]["REPORTE DE SINIESTRO"] . "'><i class='fas fa-file-pdf'></i></button></div>";
                } else {
                    $btnReporteSiniestro = "";
                }
                $estado = "<button class='btn btn-xs btn-success' estado='" . $consulta[$i]["cliente_estado_bayer"] . "'>" . $consulta[$i]["cliente_estado_bayer"] . "</button>";

                $datosJson .= '[
                            "' . $consulta[$i]["posicion"] . '",
                            "' . $consulta[$i]["contrato_numero"] . '",
                            "' . $consulta[$i]["cliente_productos"] . '",
                            "' . $btnReporteSiniestro . '",
                            "' . $estado . '"
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
$listaProspecto = new Lista_contrato_documento_cliente();
$listaProspecto->mostrar_lista_contrato_documento_cliente();
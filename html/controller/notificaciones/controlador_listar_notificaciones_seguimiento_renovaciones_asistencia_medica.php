<?php

require '../../model/modelo_notificaciones.php';

class ControladorListaNotificacionesSeguimientoRenovacionesAsistenciaMedica
{

        static public function traer_lista_notificaciones_seguimiento_renovaciones_asistencia_medica()
        {

                // 1	VIDA INDIVIDUAL
                // 2	VIDA COLECTIVA
                // 3	ASISTENCIA MEDICA INDIVIDUAL
                // 4	VEHICULOS
                // 5	ACCIDENTES PERSONALES
                // 6	SEGURO DE VIAJES

                session_start();

                date_default_timezone_set("America/Guayaquil");
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fechaActual = $fecha;
                $idCategoria = "3";

                $MU = new Modelo_Notificaciones();

                if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE" || $_SESSION['S_ROL'] == "SERVICIO CLIENTE") {
                        $consulta = $MU->listar_renovaciones_seguimiento($fechaActual, $idCategoria);
                } else {
                        $consulta = "";
                }


                if (!$consulta) {

                        // if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE") {
                        //         $lista = "<a class='nav-link' data-toggle='dropdown' href='#'>
                        //         <span class='badge badge-warning navbar-badge'>0</span>
                        //         <i class='far fa-comments'><strong class='d-none d-sm-inline-block'>Renovación </br> Asistencia Medica</strong></i>                
                        //                 </a>
                        //                 <div class='dropdown-menu dropdown-menu-lg dropdown-menu-left'>
                        //                         <span class='dropdown-item dropdown-header'>0 Notificaciones</span>
                        //                         <span class='dropdown-item dropdown-header'>LISTA RENOVACIONES - ASISTENCIA MEDICA</span>
                        //                         <div class='dropdown-divider'></div>
                        //                                 <span class='dropdown-item dropdown-header'>SIN REGISTROS</span>
                        //                         <div class='dropdown-divider'></div>
                        //                 </div>";
                        // } else {
                        //         $lista = "";
                        // }

                        $lista = "";

                        echo $lista;
                } else {
                        $lista1 = "";
                        $contar = 0;
                        for ($i = 0; $i < count($consulta); $i++) {
                                $contar = $i + 1;
                                $lista1 .= "<a href='#' class='dropdown-item notificacionEditarCliente' idCliente = '" . $consulta[$i]["bayer_id"] . "' idCategoria = '" . $consulta[$i]["categoria_id"] . "' tipo='" . $consulta[$i]["cliente_tipo"] . "'><i class='fas fa-envelope mr-2'></i> " . $contar . " Renovación seguimiento</br><i class='fas fa-user mr-2'></i> " . $consulta[$i]["cliente_nombre"] . " </br><i class='fas fa-calendar mr-2'></i> " . $consulta[$i]["contrato_fecha_fin"] . "</a>";
                        }
                        $lista = "<a class='nav-link' data-toggle='dropdown' href='#'>
                        <span class='badge badge-warning navbar-badge'>" . $contar . "</span>
                        <i class='far fa-comments'><strong class='d-none d-sm-inline-block'>Renovación </br> Asistencia Medica</strong></i>                
                                </a>
                                <div class='dropdown-menu dropdown-menu-lg dropdown-menu-left scrollable-menu'>
                                <span class='dropdown-item dropdown-header'>" . $contar . " Renovaciones</span>
                                <span class='dropdown-item dropdown-header'>LISTA RENOVACIONES - ASISTENCIA MEDICA</span>
                                        <div class='dropdown-divider'></div>
                                        " . $lista1 . "
                                        <div class='dropdown-divider'></div>
                                </div>
                                ";

                        echo $lista;
                }
        }
}

$lista_notificacion_seguimiento = new ControladorListaNotificacionesSeguimientoRenovacionesAsistenciaMedica();
$lista_notificacion_seguimiento->traer_lista_notificaciones_seguimiento_renovaciones_asistencia_medica();

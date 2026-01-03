<?php

require '../../model/modelo_notificaciones.php';

class ControladorListaNotificacionesSeguimientoSiniestroVehiculo
{

        static public function traer_lista_notificaciones_seguimiento_siniestro_vehiculo()
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
                $idategoria = "4";


                $MU = new Modelo_Notificaciones();

                if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE") {
                        $consulta = $MU->listar_siniestro_seguimiento($fechaActual, $idategoria);
                } else {
                        $consulta = $MU->listar_siniestro_seguimiento_asignado($_SESSION['S_IDUSUARIO'], $fechaActual, $idategoria);
                }


                if (!$consulta) {

                        // if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE"  || $_SESSION['S_ROL'] == "CLIENTE") {
                        //         $lista = "<a class='nav-link' data-toggle='dropdown' href='#'>
                        //         <span class='badge bg-success navbar-badge'>0</span>
                        //         <i class='far fa-bell'><strong class='d-none d-sm-inline-block'>Reembolsos </br> Asistencia Medica</strong></i>        
                        //         </a>
                        //         <div class='dropdown-menu dropdown-menu-lg dropdown-menu-left'>
                        //                 <span class='dropdown-item dropdown-header'>0 Notificaciones</span>
                        //                 <span class='dropdown-item dropdown-header'>LISTA REEMBOLSO</span>
                        //                 <div class='dropdown-divider'></div>
                        //                         <span class='dropdown-item dropdown-header'>SIN REGISTROS</span>
                        //                 <div class='dropdown-divider'></div>
                        //         </div>";
                        // }else {
                        //         $lista = "";
                        // }

                        $lista = "";

                        echo $lista;
                } else {
                        $lista1 = "";
                        $lista2 = "";
                        $contar = 0;
                        for ($i = 0; $i < count($consulta); $i++) {

                                $contar = $i + 1;

                                if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE") {
                                        $lista1 .= "<a href='siniestros-vehiculo-individual' class='dropdown-item' idCategoria = '" . $consulta[$i]["categoria_id"] . "'><i class='fas fa-envelope mr-2'></i> " . $contar . " Siniestro seguimiento</br><i class='fas fa-user mr-2'></i> " . $consulta[$i]["cliente_nombre"] . " </br><i class='fas fa-calendar mr-2'></i> " . $consulta[$i]["siniestro_fecha_seguimiento"] . "</a>";
                                        $lista2 = "<a href='siniestros-vehiculo-individual' class='dropdown-item dropdown-footer'>Ver todas las notificaciones</a>";
                                } elseif ($_SESSION['S_ROL'] == "CLIENTE") {
                                        $lista1 .= "<a href='siniestros-vehiculo-individual-cliente' class='dropdown-item' idCategoria = '" . $consulta[$i]["categoria_id"] . "'><i class='fas fa-envelope mr-2'></i> " . $contar . " Siniestro seguimiento</br><i class='fas fa-user mr-2'></i> " . $consulta[$i]["cliente_nombre"] . " </br><i class='fas fa-calendar mr-2'></i> " . $consulta[$i]["siniestro_fecha_seguimiento"] . "</a>";
                                        $lista2 = "<a href='siniestros-vehiculo-individual-cliente' class='dropdown-item dropdown-footer'>Ver todas las notificaciones</a>";
                                } else {

                                        $lista1 .= "";
                                }
                        }
                        $lista = "<a class='nav-link' data-toggle='dropdown' href='#'>
                        <span class='badge bg-success navbar-badge'>" . $contar . "</span>
                        <i class='far fa-bell'><strong class='d-none d-sm-inline-block'>Siniestros </br> Vehiculo</strong></i>                
                                </a>
                                <div class='dropdown-menu dropdown-menu-lg dropdown-menu-left scrollable-menu'>
                                <span class='dropdown-item dropdown-header'>" . $contar . " Notificaciones</span>
                                <span class='dropdown-item dropdown-header'>LISTA SINIESTRO</span>
                                        <div class='dropdown-divider'></div>
                                        " . $lista1 . "
                                        <div class='dropdown-divider'></div>
                                        " . $lista2 . "
                                </div>
                                ";

                        echo $lista;
                }
        }
}

$lista_notificacion_seguimiento = new ControladorListaNotificacionesSeguimientoSiniestroVehiculo();
$lista_notificacion_seguimiento->traer_lista_notificaciones_seguimiento_siniestro_vehiculo();

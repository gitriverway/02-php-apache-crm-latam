<?php

require '../../model/modelo_notificaciones.php';

class ControladorListaNotificacionesSeguimientoClientePymes
{

        static public function traer_lista_notificaciones_seguimiento_cliente_pymes()
        {

                /**
                 * Tipo de Cliente
                 * P = Prospecto
                 * C = Cliente
                 * **/

                session_start();

                date_default_timezone_set("America/Guayaquil");
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fechaActual = $fecha;
                $tipo = "C";
                $categoria = "E";


                $MU = new Modelo_Notificaciones();

                if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE" || $_SESSION['S_ROL'] == "SERVICIO CLIENTE") {
                        $consulta = $MU->listar_clientes_seguimiento($fechaActual, $tipo, $categoria);
                } else {
                        $consulta = $MU->listar_clientes_seguimiento_asignado($_SESSION['S_IDUSUARIO'], $fechaActual, $tipo, $categoria);
                }


                if (!$consulta) {
                        // if ($_SESSION['S_ROL'] == "ADMINISTRADOR" || $_SESSION['S_ROL'] == "GERENTE") {
                        //         $lista = "<a class='nav-link' data-toggle='dropdown' href='#'>
                        //         <span class='badge badge-danger navbar-badge'>0</span>
                        //         <i class='far fa-bell'><strong class='d-none d-sm-inline-block'>Clientes&nbsp;</strong></i>        
                        //         </a>
                        //         <div class='dropdown-menu dropdown-menu-lg dropdown-menu-left'>
                        //                 <span class='dropdown-item dropdown-header'>0 Notificaciones</span>
                        //                 <span class='dropdown-item dropdown-header'>LISTA CLIENTES</span>
                        //                 <div class='dropdown-divider'></div>
                        //                         <span class='dropdown-item dropdown-header'>SIN REGISTROS</span>
                        //                 <div class='dropdown-divider'></div>
                        //         </div>
                        //         ";
                        // }else {
                        //         $lista = "";
                        // }

                        $lista = "";

                        echo $lista;
                } else {
                        $lista1 = "";
                        $contar = 0;
                        for ($i = 0; $i < count($consulta); $i++) {
                                $contar = $i + 1;
                                $lista1 .= "<a href='#' class='dropdown-item notificacionEditarCliente' idCliente = '" . $consulta[$i]["bayer_id"] . "' idCategoria = '" . $consulta[$i]["categoria_id"] . "' tipo='" . $consulta[$i]["cliente_tipo"] . "'><i class='fas fa-envelope mr-2'></i> " . $contar . " clientes seguimiento</br><i class='fas fa-user mr-2'></i> " . $consulta[$i]["cliente_nombre"] . " </br><i class='fas fa-calendar mr-2'></i> " . $consulta[$i]["cliente_fecha_seguimiento"] . "</a>";
                        }
                        $lista = "<a class='nav-link' data-toggle='dropdown' href='#'>
                        <span class='badge badge-danger navbar-badge'>" . $contar . "</span>
                        <i class='far fa-bell'><strong class='d-none d-md-inline-block'>Clientes Pymes&nbsp;</strong></i>                
                                </a>
                                <div class='dropdown-menu dropdown-menu-lg dropdown-menu-left scrollable-menu'>
                                <span class='dropdown-item dropdown-header'>" . $contar . " Notificaciones</span>
                                <span class='dropdown-item dropdown-header'>LISTA CLIENTES PYMES</span>
                                        <div class='dropdown-divider'></div>
                                        " . $lista1 . "
                                        <div class='dropdown-divider'></div>
                                </div>
                                ";

                        echo $lista;
                }
        }
}

$lista_notificacion_seguimiento = new ControladorListaNotificacionesSeguimientoClientePymes();
$lista_notificacion_seguimiento->traer_lista_notificaciones_seguimiento_cliente_pymes();

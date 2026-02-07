<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <?php
                require_once __DIR__ . '/../../model/modelo_idioma.php';
                $t = function($key) {
                    return Modelo_Idioma::t($key);
                };
                ?>
                <div class="col-sm-6">
                    <h1><?php echo $t('common.dashboard'); ?>
                        <small><?php echo $t('common.control_panel'); ?></small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('common.dashboard'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <?php

                switch ($_SESSION["S_ROL"]) {
                    case 'ADMINISTRADOR':
                        include "inicio/cajas-superiores.php";
                        break;
                    case 'GERENTE':
                        include "inicio/cajas-superiores.php";
                        break;
                    case 'GERENTE 1':
                        // include "inicio/cajas-superiores.php";
                        break;
                    case 'SERVICIO CLIENTE':
                        include "inicio/cajas-superiores.php";
                        break;
                    case 'VENDEDOR':
                        include "inicio/cajas-superiores-vendedor.php";
                        break;
                    case 'CLIENTE':
                        include "inicio/cajas-superiores-clientes.php";
                        break;

                    default:
                        # code...
                        break;
                }

                ?>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <?php

                switch ($_SESSION["S_ROL"]) {
                    case 'ADMINISTRADOR':
                        // include "reportes/grafico-aseguradoras-vendidas.php";
                        break;
                    case 'GERENTE':
                        // include "reportes/grafico-aseguradoras-vendidas.php";
                        break;
                    case 'GERENTE 1':
                        // include "reportes/grafico-aseguradoras-vendidas.php";
                        break;
                    case 'VENDEDOR':
                        // include "reportes/grafico-aseguradoras-vendidas.php";
                        break;

                    default:
                        # code...
                        break;
                }

                //                 if($_SESSION["S_ROL"] =="ADMINISTRADOR" || $_SESSION["S_ROL"] =="GERENTE" || $_SESSION["S_ROL"] =="VENDEDOR"){

                //                 include "reportes/grafico-aseguradoras-vendidas.php";

                //                 }

                ?>
            </div>
            <!-- /.row (main row) -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="js/contadores-administradores.js?rev=<?php echo time(); ?>"></script>
<script src="js/contadores-clientes.js?rev=<?php echo time(); ?>"></script>
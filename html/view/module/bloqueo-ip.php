<?php

if($_SESSION["S_ROL"] != "ADMINISTRADOR" && $_SESSION["S_ROL"] != "GERENTE"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
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
                    <h1><?php echo $t('messages.ip_blocking_list'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.ip_blocking_list'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $t('messages.welcome_ip_blocking_content'); ?></h3>
                <div class="card-tools pull-right">
                    <!-- <a href="crear-prospecto">
                        <button class="btn btn-primary" style="width:100%"><i class="glyphicon glyphicon-plus"></i>Nuevo
                            Registro</button>
                    </a> -->
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_bloqueo_ip" class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Direcci&oacute;n Ip</th>
                            <th style="text-align:center; width:10px">Contador</th>
                            <th style="text-align:center; width:10px">Descripci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="js/bloqueo_ip.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_bloqueo_ip();
});
</script>
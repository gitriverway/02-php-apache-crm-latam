<?php

if ($_SESSION["S_ROL"] == "CLIENTE") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';

    return;
}

require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function($key) {
    return Modelo_Idioma::t($key);
};
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $t('messages.manage_prospects_pymes'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.manage_prospects_pymes'); ?></li>
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
                <!-- <h3 class="card-title">BIENVENIDO AL CONTENIDO DE PROSPECTOS</h3> -->
                <div class="card-tools pull-right">
                    <a href="crear-prospecto-empresarial">
                        <button class="btn btn-primary" style="width:100%"><i class="fa fa-plus"><b>&nbsp;<?php echo $t('messages.new_record'); ?></i></b></button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_prospecto_empresarial" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <?php

                        if ($_SESSION["S_ROL"] == "GERENTE") {

                            echo '<tr>
                            <th colspan="18">
                                <button style="width:100%" id="btnListaVendedor"
                                    class="form-control btn btn-primary">' . $t('messages.assign') . '</button>
                            </th>
                        </tr>';
                        }

                        ?>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            <th style="text-align:center; width:10px">
                                <div class="form-check">
                                    <!-- <input class="form-check-input chkSeleccionarTodoAsignar" id="chkSeleccionarTodoAsignar" name="chkSeleccionarTodoAsignar" type="checkbox"> -->
                                    <label class="form-check-label"><?php echo $t('messages.select_all'); ?></label>
                                </div>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.bayer_status'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.seller'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.prospect'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.id_card_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.follow_up_date'); ?></th>
                            <th style="text-align:center; width:150px"><?php echo $t('messages.branches'); ?></th>
                            <th style="text-align:center; width:150px"><?php echo $t('messages.products'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.province_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.phone_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.provider_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.plans'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.origin_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.year'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.month_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.registration_date_table'); ?></th>
                        </tr>
                    </thead>
                </table>
                <input type="text" id="txt_idProspecto" name="txt_idProspecto" hidden>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
<?php echo $t('modal.assign_seller'); ?>
======================================-->
<div id="modal_asignar_vendedor" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('messages.seller_list'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabla_lista_vendedores" class="table table-bordered table-striped dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:10px">#</th>
                                <th><?php echo $t('messages.seller'); ?></th>
                                <th><?php echo $t('messages.position'); ?></th>
                                <th><?php echo $t('messages.action_table'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL MODIFICAR ESTADO BAYER PERSONA
======================================-->

<div id="modal_estado_bayer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('messages.modify_bayer_status'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA SELECCIONAR EMPLEADO -->
                        <div class="form-group">
                            <label for="cbm_estado_bayer" class="control-label" style="text-align: right;"><?php echo $t('messages.bayer_status_label'); ?>
                            </label>
                            <select class="form-control cbm_estado_bayer js-example-basic-single" name="state"
                                id="cbm_estado_bayer" style="width:100%;">
                                <option value="ABIERTO">ABIERTO</option>
                                <!-- <option value="NO CONTESTA">NO CONTESTA</option> -->
                                <option value="NO INTERESADO">NO INTERESADO</option>
                                <option value="INTERESADO">INTERESADO</option>
                                <option value="INTERESADO ALTO">INTERESADO ALTO</option>
                                <option value="INTERESADO MEDIO">INTERESADO MEDIO</option>
                                <option value="INTERESADO BAJO">INTERESADO BAJO</option>
                                <option value="CONTRATADO">CONTRATADO</option>
                                <option value="DUPLICADO">DUPLICADO</option>
                                <option value="NO RECUPERADO">NO RECUPERADO</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Modificar_Estado_Bayer_Cliente()"><i
                            class="fa fa-save"><b>&nbsp;<?php echo $t('messages.update_button'); ?></b></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;<?php echo $t('messages.close_button'); ?></b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/prospecto-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
$(document).ready(function() {
    listar_prospecto_empresarial();
    listar_vendedores();
});
</script>
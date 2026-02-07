<?php

if ($_SESSION["S_ROL"] == "CLIENTE") {

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
                $t = function ($key) {
                    return Modelo_Idioma::t($key);
                };
                ?>
                <div class="col-sm-6">
                    <h1><?php echo $t('messages.manage_providers'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.manage_providers'); ?></li>
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
                <div class="card-tools pull-right">
                    <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;<?php echo $t('messages.new_record'); ?>
                        </i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_proveedor" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th style="text-align:center"><?php echo $t('list_tables.provider'); ?></th>
                            <th style="text-align:center"><?php echo $t('messages.refund_email'); ?></th>
                            <th style="text-align:center"><?php echo $t('messages.claims_email'); ?></th>
                            <th style="text-align:center"><?php echo $t('messages.hospital_credit_email'); ?></th>
                            <th style="text-align:center"><?php echo $t('messages.ambulatory_credit_email'); ?></th>
                            <th style="text-align:center"><?php echo $t('messages.home_claims_email'); ?></th>
                            <th style="text-align:center"><?php echo $t('list_tables.registration_date'); ?></th>
                            <th style="text-align:center"><?php echo $t('messages.modification_date'); ?></th>
                            <th style="text-align:center"><?php echo $t('list_tables.status'); ?></th>
                            <th style="text-align:center"><?php echo $t('list_tables.actions'); ?></th>
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
<!--=====================================
MODAL REGISTRO USUARIO
======================================-->


<div id="modal_registro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('messages.provider_registration'); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <!-- ENTRADA PARA EL NOMBRE DEL PROVEEDOR -->
                            <div class="form-group col-12">
                                <label for="txt_proveedor" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.name'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_proveedor"
                                        placeholder="<?php echo $t('form.enter_name'); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- ENTRADA PARA DIRECCION -->
                            <div class="form-group col-12">
                                <label for="txt_direccion_proveedor" class="control-label"
                                    style="text-align: right;"><?php echo $t('messages.address'); ?>
                                </label>
                                <div class="input-group">
                                    <textarea class="form-control validarNumerosLetrasDecimal"
                                        id="txt_direccion_proveedor" name="txt_direccion_proveedor" cols="20" rows="3"
                                        placeholder="<?php echo $t('messages.enter_direction'); ?>"></textarea>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- ENTRADA PARA EL CORREO DEL PROVEEDOR -->
                            <div class="col-12">
                                <button type="button"
                                    class="btn btn-default btnAgregarNuevoCorreo"><?php echo $t('messages.add_email'); ?></button>
                                <input type="hidden" id="listaCorreoReembolsos" name="listaCorreoReembolsos">
                                <input type="hidden" id="listaCorreoSiniestros" name="listaCorreoSiniestros">
                                <input type="hidden" id="listaCorreoOperatorios" name="listaCorreoOperatorios">
                                <input type="hidden" id="listaCorreoCreditoAmbulatorio"
                                    name="listaCorreoCreditoAmbulatorio">
                                <input type="hidden" id="listaCorreoSiniestrosHogar" name="listaCorreoSiniestrosHogar">
                                <div class="row listaNuevosCorreos">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Registrar_Proveedor()"><i
                            class="fa fa-save"><b>&nbsp;<?php echo $t('messages.register'); ?></b></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;<?php echo $t('common.cancel'); ?></b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!--=====================================
CABEZA DEL MODAL
======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title"><b><?php echo $t('messages.edit_provider_data'); ?></b></h4>
                </div>
                <!--=====================================
CUERPO DEL MODAL
======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <input type="hidden" id="txtidproveedor">
                            <!-- ENTRADA PARA EL PROVEEDOR -->
                            <div class="form-group col-12">
                                <label for="txt_proveedor_editar" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.name'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control validarNumerosLetras"
                                        id="txt_proveedor_editar"
                                        placeholder="<?php echo $t('messages.enter_provider'); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                            </div>

                            <!-- ENTRADA PARA DIRECCION -->
                            <div class="form-group col-12">
                                <label for="txt_direccion_proveedor_editar" class="control-label"
                                    style="text-align: right;"><?php echo $t('messages.address'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <div class="input-group">
                                    <textarea class="form-control validarNumerosLetrasDecimal"
                                        id="txt_direccion_proveedor_editar" name="txt_direccion_proveedor_editar"
                                        cols="20" rows="3"
                                        placeholder="<?php echo $t('messages.enter_direction'); ?>"></textarea>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- ENTRADA PARA EL CORREO DEL PROVEEDOR -->
                            <div class="col-12">
                                <button type="button"
                                    class="btn btn-default btnAgregarEditarCorreo"><?php echo $t('messages.add_email'); ?></button>
                                <input type="hidden" id="listaCorreoEditarReembolsos"
                                    name="listaCorreoEditarReembolsos">
                                <input type="hidden" id="listaCorreoEditarSiniestros"
                                    name="listaCorreoEditarSiniestros">
                                <input type="hidden" id="listaCorreoEditarOperatorios"
                                    name="listaCorreoEditarOperatorios">
                                <input type="hidden" id="listaCorreoEditarCreditoAmbulatorio"
                                    name="listaCorreoEditarCreditoAmbulatorio">
                                <input type="hidden" id="listaCorreoEditarSiniestrosHogar"
                                    name="listaCorreoEditarSiniestrosHogar">
                                <div class="row listaEditarCorreos">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Modificar_Proveedor()"><i
                            class="fa fa-save"><b>&nbsp;<?php echo $t('common.update'); ?></b></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;<?php echo $t('common.cancel'); ?></b></i></button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/proveedor.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_proveedores();
        lista1();
        $("#modal_registro").on('shown.bs.modal', function() {
            $("#txt_proveedor").focus();
        });
    });
</script>
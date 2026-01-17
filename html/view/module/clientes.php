<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

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
                <div class="col-sm-6">
                    <h1><?php echo $t('messages.list_clients'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.list_clients'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <table id="tabla_cliente" class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.name'); ?> </th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.id_card'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.birth_date'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.gender'); ?></th>
                            <th style="text-align:center; width:10px">Email</th>
                            <th style="text-align:center; width:10px">Enviar Acceso</th>
                            <th style="text-align:center; width:10px">Recuperar Contrase&ntilde;a</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idCliente" value="0">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!--=====================================
MODAL ASIGNAR VENDEDOR
======================================-->
<div id="modal_editar_cliente" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.edit_client'); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA EL DOCUMENTO -->
                            <div class="form-group">
                                <label for="txt_documento" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.id_card'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_documento"
                                        placeholder="<?php echo $t('form.enter_id_card'); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA NOMBRE -->
                            <div class="form-group">
                                <label for="txt_nombre" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.name'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetras" id="txt_nombre"
                                    placeholder="<?php echo $t('form.enter_name'); ?>" maxlength="50" autocomplete="off"
                                    style="text-transform: uppercase">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA GENERO-->
                            <div class="form-group">
                                <label class="control-label" style="text-align: right;"><?php echo $t('form.gender'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <select id="genero" name="genero" class="form-control genero" required>
                                    <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                    <option value="masculino"><?php echo $t('form.male'); ?></option>
                                    <option value="femenino"><?php echo $t('form.female'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA FECHA DE NACIMIENTO -->
                            <div class="form-group">
                                <label for="txt_fecha_nacimiento" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.birth_date'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="date" class="form-control" id="txt_fecha_nacimiento" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA EMAIl -->
                            <div class="form-group">
                                <label for="txt_email" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.email'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetrasDecimal" id="txt_email"
                                    placeholder="<?php echo $t('form.enter_email'); ?>" maxlength="50"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA TELEFONO -->
                            <div class="form-group">
                                <label for="txt_telefono" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.phone'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetras" id="txt_telefono"
                                    placeholder="<?php echo $t('form.enter_phone'); ?>" maxlength="50"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                            <div class="form-group">
                                <label for="cbm_provincia" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.province'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <select class="form-control cbm_provincia" name="state" id="cbm_provincia">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA SELECCIONAR CIUDAD -->
                            <div class="form-group">
                                <label for="txt_ciudad" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.city'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetras" id="txt_ciudad"
                                    placeholder="<?php echo $t('form.enter_city'); ?>" maxlength="100"
                                    autocomplete="off" style="text-transform: uppercase">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!-- ENTRADA PARA DIRECCION -->
                            <div class="form-group">
                                <label for="txt_direccion" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.address'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetras" id="txt_direccion"
                                    placeholder="<?php echo $t('form.enter_address'); ?>" maxlength="50"
                                    autocomplete="off" style="text-transform: uppercase">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA OCUPACION -->
                            <div class="form-group">
                                <label for="txt_ocupacion" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.profession'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetras" id="txt_ocupacion"
                                    placeholder="<?php echo $t('form.enter_occupation'); ?>" maxlength="50"
                                    autocomplete="off" style="text-transform: uppercase">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA INGRESOS -->
                            <div class="form-group">
                                <label for="cbm_ingreso_mensual" class="control-label"
                                    style="text-align: right;"><?php echo $t('form.income'); ?>
                                    <font color="red"> *</font>
                                </label>
                                <select class="form-control cbm_ingreso_mensual" name="state" id="cbm_ingreso_mensual"
                                    style="width:100%;">
                                    <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                    <option value="0 a 1000"><?php echo $t('form.0_to_1000'); ?></option>
                                    <option value="1000 a 3000"><?php echo $t('form.1000_to_3000'); ?></option>
                                    <option value="3000 a 5000"><?php echo $t('form.3000_to_5000'); ?></option>
                                    <option value="5000 en adelante"><?php echo $t('form.more_than_5000'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal"><?php echo $t('common.cancel'); ?></button>
                    <button type="submit" class="btn btn-primary"
                        onclick="Modificar_Cliente()"><?php echo $t('common.update'); ?> </button>
                </div>
                <!-- <div class="overlay">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div> -->
            </form>
        </div>
    </div>
</div>


<script src="js/clientes.js?rev=<?php echo time(); ?>"></script>
<script>
$(document).ready(function() {
    listar_cliente();
    listar_combo_provincia();
});
</script>
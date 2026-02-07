<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
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
            <div class="row">
                <div class="col-sm-6">
                    <h1><?php echo $t("common.create_prospect_pymes"); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t("common.home"); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t("common.create_prospect_pymes"); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary" id="cardBayer">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t("form.bayer_person_data"); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <input type="hidden" id="txt_idProspecto" value="0">
                                <!-- ENTRADA PARA EL ORIGEN CLIENTE -->
                                <div class="form-group">
                                    <label for="cbm_origen" class=" control-label" style="text-align: right;">
                                        <?php echo $t("form.origin"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_origen" name="state" id="cbm_origen">
                                        <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                        <option value="MQP">RIVERWAY</option>
                                        <option value="AMIGO"><?php echo $t('list_tables.origin_friend'); ?></option>
                                        <option value="CHAT"><?php echo $t('list_tables.origin_chat'); ?></option>
                                        <option value="OTROS"><?php echo $t('list_tables.origin_others'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA LOS RAMOS -->
                                <div class="form-group">
                                    <label for="cbm_categoria" class=" control-label"
                                        style="text-align: right;"><?php echo $t("form.category"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_categoria" name="state" id="cbm_categoria">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA EL NUEVO RAMO -->
                                <div class="form-group">
                                    <label for="txt_nuevo_categoria" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.new_category"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras"
                                        id="txt_nuevo_categoria" autocomplete="off" style="text-transform: uppercase"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA LA ASEGURADORA-->
                                <div class="form-group">
                                    <label for="cbm_proveedor" class=" control-label"
                                        style="text-align: right;"><?php echo $t("form.provider"); ?>
                                    </label>
                                    <select class="form-control cbm_proveedor" name="state" id="cbm_proveedor">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PLAN DE SEGURO-->
                                <div class="form-group">
                                    <label for="txt_planes" class=" control-label" style="text-align: right;">
                                        <?php echo $t("form.plan"); ?>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control validarNumerosLetras" id="txt_planes"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA VALOR ASEGURADO -->
                                <div class="form-group">
                                    <label for="txt_valor_asegurado" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.sum_insured"); ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_valor_asegurado"
                                            placeholder="<?php echo $t("form.enter_sum_insured"); ?>" value="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA NETA -->
                                <div class="form-group">
                                    <label for="txt_prima_neta" class="control-label" style="text-align: right;">
                                        <?php echo $t("form.net_premium"); ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_neta"
                                            placeholder="<?php echo $t("form.enter_net_premium"); ?>" value="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA COMISIONABLE -->
                                <div class="form-group">
                                    <label for="txt_prima_comisionable" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.commissionable_premium"); ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_comisionable"
                                            placeholder="<?php echo $t("form.enter_commissionable_premium"); ?>"
                                            value="0" maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA TOTAL -->
                                <div class="form-group">
                                    <label for="txt_prima_total" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.total_premium"); ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_total"
                                            placeholder="<?php echo $t("form.enter_total_premium"); ?>" value="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA SELECCIONAR FORMA DE PAGO -->
                                <div class="form-group">
                                    <label for="cbm_tipo_pago" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.payment_frequency"); ?></label>
                                    <select class="form-control cbm_tipo_pago" name="state" id="cbm_tipo_pago"
                                        style="width:100%;">
                                        <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                        <option value="MENSUAL"><?php echo $t("form.month"); ?></option>
                                        <option value="TRIMESTRAL"><?php echo $t("form.quarterly"); ?></option>
                                        <option value="SEMESTRAL"><?php echo $t("form.semi_annual"); ?></option>
                                        <option value="ANUAL"><?php echo $t("form.annual"); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA SELECCIONAR FORMA DE PAGO -->
                                <div class="form-group">
                                    <label for="cbm_forma_pago" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.payment_method"); ?></label>
                                    <select class="form-control cbm_forma_pago" name="state" id="cbm_forma_pago"
                                        style="width:100%;">
                                        <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                        <option value="DEBITO BANCARIO"><?php echo $t("form.bank_debit"); ?>
                                        </option>
                                        <option value="TRANSFERENCIA BANCARIO">
                                            <?php echo $t("form.bank_transfer"); ?></option>
                                        <option value="TARJETA DE CREDITO"><?php echo $t("form.credit_card"); ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <!-- Default box -->
                <div class="card card-primary" id="cardPersonal">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t("form.personal_information"); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA EL DOCUMENTO -->
                                <div class="form-group">
                                    <label for="txt_documento" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.id_card"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control validarNumerosLetras" id="txt_documento"
                                            placeholder="<?php echo $t("form.enter_id_card"); ?>" autocomplete="off"
                                            style="text-transform: uppercase">
                                        <input type="hidden" id="txt_idCliente">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary btnListarClientes"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA NOMBRE -->
                                <div class="form-group">
                                    <label for="txt_nombre" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.razon_social"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_nombre"
                                        placeholder="<?php echo $t("form.enter_name"); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EMAIl -->
                                <div class="form-group">
                                    <label for="txt_email" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.email"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetrasDecimal" id="txt_email"
                                        placeholder="<?php echo $t("form.enter_email"); ?>" maxlength="50"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA TELEFONO -->
                                <div class="form-group">
                                    <label for="txt_telefono" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.phone"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_telefono"
                                        placeholder="<?php echo $t("form.enter_phone"); ?>" maxlength="50"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                                <div class="form-group">
                                    <label for="cbm_provincia" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.province"); ?>
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
                                        style="text-align: right;"><?php echo $t("form.city"); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_ciudad"
                                        placeholder="<?php echo $t("form.enter_city"); ?>" maxlength="100"
                                        autocomplete="off" style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA DIRECCION -->
                                <div class="form-group">
                                    <label for="txt_direccion" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.address"); ?>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_direccion"
                                        placeholder="<?php echo $t("form.enter_address"); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA OCUPACION -->
                                <div class="form-group">
                                    <label for="txt_ocupacion" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.occupation"); ?><font
                                            color="red"> *</font>
                                    </label>
                                    <textarea name="txt_ocupacion" id="txt_ocupacion"
                                        class="form-control validarNumerosLetras" rows="1" autocomplete="off"
                                        style="text-transform: uppercase"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <!-- ENTRADA PARA INGRESOS -->
                                <div class="form-group">
                                    <label for="cbm_ingreso_mensual" class="control-label"
                                        style="text-align: right;"><?php echo $t("form.income"); ?><font color="red"> *
                                        </font>
                                    </label>
                                    <select class="form-control cbm_ingreso_mensual" name="state"
                                        id="cbm_ingreso_mensual" style="width:100%;">
                                        <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                        <option value="0 a 1000"><?php echo $t('form.0_to_1000'); ?></option>
                                        <option value="1000 a 3000"><?php echo $t('form.1000_to_3000'); ?></option>
                                        <option value="3000 a 5000"><?php echo $t('form.3000_to_5000'); ?></option>
                                        <option value="5000 en adelante"><?php echo $t('form.more_than_5000'); ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-sm-12">
                <!-- Default box -->
                <div class="card card-primary" id="cardDependientes">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t("form.collaborators_information"); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <!--=====================================
                                        BOTÓN PARA AGREGAR DEPENDIENTE
                                        ======================================-->
                                        <div class="form-group row">
                                            <button type="button"
                                                class="btn btn-default btnAgregarColaborador"><?php echo $t("form.add_collaborators"); ?></button>
                                            <input type="hidden" id="listaColaboradores" name="listaColaboradores">
                                            <input type="hidden" id="txt_idColaborador" name="txt_idColaborador"
                                                value="0">
                                        </div>
                                        <!--=====================================
                                        ENTRADA PARA AGREGAR DEPENDIENTE
                                        ======================================-->

                                        <div class="form-group row nuevoColaborador">

                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <!--=====================================
                                BOTÓN PARA AGREGAR VEHICULO
                                ======================================-->
                                        <div class="form-group row">
                                            <input type="hidden" id="listaVehiculos" name="listaVehiculos">
                                        </div>
                                        <!--=====================================
                                ENTRADA PARA AGREGAR VEHICULO
                                ======================================-->

                                        <div class="form-group row nuevoVehiculo">

                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <!--=====================================
                                BOTÓN PARA AGREGAR OBSERACIONES
                                ======================================-->
                                        <div class="form-group row">
                                            <button type="button"
                                                class="btn btn-default btnAgregarObservacion"><?php echo $t("form.add_observation"); ?></button>
                                            <input type="hidden" id="listaObservaciones" name="listaObservaciones">
                                        </div>
                                        <!--=====================================
                                TABLA DE OBSERVACIONES
                                ======================================-->
                                        <div class="form-group row nuevaObservacion">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <!-- ENTRADA PARA FECHA DE SEGUIMIENTO -->
                                        <div class="form-group">
                                            <label for="txt_fecha_seguimiento" class="control-label"
                                                style="text-align: right;"><?php echo $t("form.follow_up"); ?></label>
                                            <input type="date" class="form-control" id="txt_fecha_seguimiento"
                                                id="txt_fecha_seguimiento">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <!-- ENTRADA PARA SELECCIONAR ESTADO BAYER -->
                                        <div class="form-group">
                                            <label for="cbm_estado_bayer" class="control-label"
                                                style="text-align: right;"><?php echo $t("form.status"); ?><font
                                                    color="red"> *</font>
                                            </label>
                                            <select class="form-control cbm_estado_bayer" name="state"
                                                id="cbm_estado_bayer" style="width:100%;">
                                                <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
                                                <option value="ABIERTO"><?php echo $t("form.open"); ?></option>
                                                <!-- <option value="NO CONTESTA">NO CONTESTA</option> -->
                                                <option value="NO INTERESADO"><?php echo $t("form.no_interested"); ?>
                                                </option>
                                                <option value="INTERESADO"><?php echo $t("form.interested"); ?></option>
                                                <option value="INTERESADO ALTO">
                                                    <?php echo $t("form.highly_interested"); ?></option>
                                                <option value="INTERESADO MEDIO">
                                                    <?php echo $t("form.medium_interested"); ?></option>
                                                <option value="INTERESADO BAJO"><?php echo $t("form.low_interested"); ?>
                                                </option>
                                                <option value="CONTRATADO"><?php echo $t("form.contracted"); ?></option>
                                                <option value="DUPLICADO"><?php echo $t("form.duplicated"); ?></option>
                                                <option value="NO RECUPERADO"><?php echo $t("form.not_recovered"); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a href="prospecto-asignado-empresarial"><button type="button" class="btn btn-default"
                                        data-dismiss="modal"><?php echo $t("common.cancel"); ?></button></a>
                                <button type="submit" class="btn btn-primary float-right"
                                    onclick="Registrar_Cliente()"><i
                                        class="fa fa-save"><b>&nbsp;<?php echo $t("common.save"); ?></b></i></button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div id="modalListarClientes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t("list_modal.list_clients"); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table id="tabla_lista_clientes" class="table table-bordered table-striped dt-responsive"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:10px">#</th>
                                    <th style="text-align:center; width:10px"><?php echo $t("list_tables.customer"); ?>
                                    </th>
                                    <th style="text-align:center; width:10px"><?php echo $t("list_tables.id_card"); ?>
                                    </th>
                                    <th style="text-align:center; width:10px"><?php echo $t("list_tables.action"); ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modalListarDependientesColaborador" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t("list_modal.dependent_list"); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <!--=====================================
                        BOTÓN PARA AGREGAR DEPENDIENTE
                        ======================================-->
                        <div class="form-group row">
                            <button type="button"
                                class="btn btn-default btnAgregarDependiente"><?php echo $t("list_tables.add_dependents"); ?></button>
                        </div>
                        <!--=====================================
                        ENTRADA PARA AGREGAR DEPENDIENTE
                        ======================================-->

                        <div class="form-group row nuevoDependiente">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $t("list_tables.cancel"); ?></button>

                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"
                            onclick="Registrar_Dependientes_Colaborador()"><b>&nbsp;<?php echo $t("list_tables.save"); ?></b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalAgregarObservacion" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t("list_modal.add_observation"); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                        <label for="txt_observacion" class="control-label"
                            style="text-align: right;"><?php echo $t("form.add_observation"); ?>
                            <font color="red"> *</font>
                        </label>
                        <textarea class="form-control validarNumerosLetrasDecimal" id="txt_observacion"
                            name="txt_observacion" cols="20" rows="5"
                            placeholder="<?php echo $t("form.add_observation"); ?>"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal"><?php echo $t("common.cancel"); ?></button>
                    <button type="submit" class="btn btn-primary"
                        onclick="agregarNuevaObservacion()"><?php echo $t("common.add"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/prospecto-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_clientes_para_seleccionar();
        listar_combo_categoria();
        listar_combo_aseguradora();
        listar_combo_provincia();
        $("#modalAgregarObservacion").on('shown.bs.modal', function() {
            $("#txt_observacion").focus();
        });

    });
</script>
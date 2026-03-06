<?php

if ($_SESSION["S_ROL"] == "CLIENTE") {
    echo '<script>window.location = "inicio";</script>';
    return;
}

require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1><?php echo $t('common.edit_emission_fire_empresarial'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('common.edit_emission_fire_empresarial'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- Default box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t('forms.bayer_person_data'); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- ENTRADA VENDEDOR -->
                                <div class="form-group">
                                    <label for="txt_vendedor" class="control-label"
                                        style="text-align: right;"><?php echo $t('list_tables.seller'); ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="txt_vendedor" autocomplete="off"
                                            style="text-transform: uppercase" readonly>
                                        <input type="text" id="txt_idEmpleado" hidden>
                                        <div class="input-group-append">
                                            <?php
                                            if ($_SESSION["S_ROL"] == "GERENTE") {
                                                echo '<button type="submit" class="btn btn-primary btnListarEmpleados"><i class="fas fa-search"></i></button>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <input type="hidden" id="txt_idBayer" value="<?php echo $_GET["idCliente"]; ?>">
                                <!-- ENTRADA PARA EL ORIGEN CLIENTE -->
                                <div class="form-group">
                                    <label for="cbm_origen" class=" control-label" style="text-align: right;"><?php echo $t('forms.origin'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_origen" name="state" id="cbm_origen">
                                        <option value=""><?php echo $t('forms.select_option'); ?></option>
                                        <option value="MQP"><?php echo $t('list_tables.origin_mqp'); ?></option>
                                        <option value="AMIGO"><?php echo $t('list_tables.origin_friend'); ?></option>
                                        <option value="CHAT"><?php echo $t('list_tables.origin_chat'); ?></option>
                                        <option value="OTROS"><?php echo $t('list_tables.origin_others'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="txt_categoria" class="control-label" style="text-align: right;"><?php echo $t('forms.categories'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_categoria"
                                        autocomplete="off" style="text-transform: uppercase" readonly>
                                    <input type="hidden" id="txt_idcategoria">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA LA ASEGURADORA-->
                                <div class="form-group">
                                    <label for="cbm_proveedor" class=" control-label"
                                        style="text-align: right;"><?php echo $t('common.provider'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_proveedor" name="state" id="cbm_proveedor">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="cbm_proveedor" class=" control-label" style="text-align: right;"><?php echo $t('common.insurance_plan'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control validarNumerosLetras" id="txt_planes"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="txt_valor_asegurado" class="control-label"
                                        style="text-align: right;"><?php echo $t('common.sum_insured'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_valor_asegurado" placeholder="<?php echo $t('forms.enter_sum_insured'); ?>" min=" 0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="txt_prima_neta" class="control-label" style="text-align: right;"><?php echo $t('common.net_premium'); ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_neta" placeholder="<?php echo $t('forms.enter_net_premium'); ?>" min="0" maxlength="30"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="txt_prima_comisionable" class="control-label"
                                        style="text-align: right;"><?php echo $t('common.commissionable_premium'); ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_comisionable" placeholder="<?php echo $t('forms.enter_commissionable_premium'); ?>"
                                            min="0" maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA TOTAL -->
                                <div class="form-group">
                                    <label for="txt_prima_total" class="control-label" style="text-align: right;"><?php echo $t('common.total_premium'); ?><font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_total" placeholder="<?php echo $t('forms.enter_total_premium'); ?>" min=" 0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="cbm_tipo_pago" class="control-label"
                                        style="text-align: right;"><?php echo $t('common.payment_frequency'); ?><font color="red"> *</font></label>
                                    <select class="form-control cbm_tipo_pago" name="state" id="cbm_tipo_pago"
                                        style="width:100%;">
                                        <option value=""><?php echo $t('messages.select_option'); ?></option>
                                        <option value="MENSUAL"><?php echo $t('common.monthly'); ?></option>
                                        <option value="TRIMESTRAL"><?php echo $t('common.quarterly'); ?></option>
                                        <option value="SEMESTRAL"><?php echo $t('common.semi_annual'); ?></option>
                                        <option value="ANUAL"><?php echo $t('common.annual'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="cbm_forma_pago" class="control-label" style="text-align: right;"><?php echo $t('common.payment_method'); ?><font color="red"> *</font></label>
                                    <select class="form-control cbm_forma_pago" name="state" id="cbm_forma_pago"
                                        style="width:100%;">
                                        <option value=""><?php echo $t('messages.select_option'); ?></option>
                                        <option value="DEBITO BANCARIO"><?php echo $t('common.bank_debit'); ?></option>
                                        <option value="TRANSFERENCIA BANCARIO"><?php echo $t('common.bank_transfer'); ?></option>
                                        <option value="TARJETA DE CREDITO"><?php echo $t('common.credit_card'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <!-- Default box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t('titles.information_personal'); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA EL DOCUMENTO -->
                                <div class="form-group">
                                    <label for="txt_documento" class="control-label" style="text-align: right;"><?php echo $t('common.id_card'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control validarNumerosLetras" id="txt_documento"
                                            placeholder="<?php echo $t('forms.enter_id_card'); ?>" autocomplete="off"
                                            style="text-transform: uppercase">
                                        <input type="hidden" id="txt_idCliente">
                                        <!-- <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary btnListarClientes"><i
                                                    class="fas fa-search"></i></button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA NOMBRE -->
                                <div class="form-group">
                                    <label for="txt_nombre" class="control-label" style="text-align: right;"><?php echo $t('common.name'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_nombre"
                                        placeholder="<?php echo $t('forms.enter_name'); ?>" maxlength="50" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" style="text-align: right;"><?php echo $t('common.gender'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <select id="genero" name="genero" class="form-control genero" required>
                                        <option value=""><?php echo $t('forms.select_option'); ?></option>
<option value="masculino"><?php echo $t('forms.male'); ?></option>
                                    <option value="femenino"><?php echo $t('forms.female'); ?></option>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="txt_fecha_nacimiento" class="control-label"
                                        style="text-align: right;">F.NACIMIENTO
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="date" class="form-control" id="txt_fecha_nacimiento"
                                        autocomplete="off">
                                </div>
                            </div> -->
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EMAIl -->
                                <div class="form-group">
                                    <label for="txt_email" class="control-label" style="text-align: right;">EMAIL
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetrasDecimal" id="txt_email"
                                        placeholder="<?php echo $t('forms.enter_email'); ?>" maxlength="50" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EMAIl -->
                                <div class="form-group">
                                    <label for="txt_email_opcional" class="control-label"
                                        style="text-align: right;">EMAIL (OPCIONAL)
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetrasDecimal"
                                        id="txt_email_opcional" placeholder="<?php echo $t('forms.enter_email'); ?>" maxlength="50"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA TELEFONO -->
                                <div class="form-group">
                                    <label for="txt_telefono" class="control-label" style="text-align: right;"><?php echo $t('common.phone'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_telefono"
                                        placeholder="<?php echo $t('forms.enter_phone'); ?>" maxlength="50" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA TELEFONO -->
                                <div class="form-group">
                                    <label for="txt_telefono_opcional" class="control-label"
                                        style="text-align: right;"><?php echo $t('common.phone'); ?> (<?php echo $t('common.optional'); ?>)
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras"
                                        id="txt_telefono_opcional" placeholder="<?php echo $t('forms.enter_phone'); ?>" maxlength="50"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                                <div class="form-group">
                                    <label for="cbm_provincia" class="control-label"
                                        style="text-align: right;"><?php echo $t('common.province'); ?><font color="red"> *</font></label>
                                    <select class="form-control cbm_provincia" name="state" id="cbm_provincia">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR CIUDAD -->
                                <div class="form-group">
                                    <label for="txt_ciudad" class="control-label" style="text-align: right;"><?php echo $t('common.city'); ?>
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_ciudad"
                                        placeholder="<?php echo $t('forms.enter_city'); ?>" maxlength="100" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA DIRECCION -->
                                <div class="form-group">
                                    <label for="txt_direccion" class="control-label"
                                        style="text-align: right;"><?php echo $t('common.address'); ?>
                                        DOMICILIO<font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_direccion"
                                        placeholder="<?php echo $t('forms.enter_address'); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA OCUPACION -->
                                <div class="form-group">
                                    <label for="txt_ocupacion" class="control-label"
                                        style="text-align: right;">PROFESI&Oacute;N
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_ocupacion"
                                        placeholder="<?php echo $t('forms.enter_occupation'); ?>" maxlength="50" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA INGRESOS -->
                                <div class="form-group">
                                    <label for="cbm_ingreso_mensual" class="control-label"
                                        style="text-align: right;">INGRESOS
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_ingreso_mensual" name="state"
                                        id="cbm_ingreso_mensual" style="width:100%;">
                                        <option value=""><?php echo $t('forms.select_option'); ?></option>
                                        <option value="0 a 1000">0 a 1000</option>
                                        <option value="1000 a 3000">1000 a 3000</option>
                                        <option value="3000 a 5000">3000 a 5000</option>
                                        <option value="5000 en adelante">5000 en adelante</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-12">
                <input type="hidden" id="listaDependientesContrato" name="listaDependientesContrato">
                <input type="hidden" id="listaContratos" name="listaContratos">
                <input type="hidden" id="listaTotalCondiciones" name="listaTotalCondiciones">
                <div class="row listaAdicional">
                </div>
            </div>

            <div class="col-md-12">
                <!-- Default box -->
                <div class="card card-primary" id="cardDocumento">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t('titles.information_documents'); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary btnListaContratos"
                                            style="padding-left: 25px; padding-right: 25px;" id="btnListaContratos"><i
                                                class='fa fa-edit'></i> &nbsp;Listar Documentos</button>
                                    </div>
                                    <div class="col-sm-12" id="agregarContrato">
                                        <!--=====================================
                                ENTRADA PARA AGREGAR DOCUMENTOS
                                ======================================-->
                                        <div class="form-group row" id="grupo_file">
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_1" class="control-label"
                                                    style="text-align: right;">CEDULA<font color="red"> *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_1"
                                                    name="txt_documento_1" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_2" class="control-label"
                                                    style="text-align: right;">CONTRATO<font color="red"> *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_2"
                                                    name="txt_documento_2" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_3" class="control-label"
                                                    style="text-align: right;">FACTURA<font color="red"> *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_3"
                                                    name="txt_documento_3" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_4" class="control-label"
                                                    style="text-align: right;">CARTA NOMBRAMIENTO<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_4"
                                                    name="txt_documento_4" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_5" class="control-label"
                                                    style="text-align: right;">FORMULARIO VINCULACIÓN<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_5"
                                                    name="txt_documento_5" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_6" class="control-label"
                                                    style="text-align: right;">ENDOSOS<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_6"
                                                    name="txt_documento_6" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_7" class="control-label"
                                                    style="text-align: right;">REPORTE DE SINIESTRO<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_7"
                                                    name="txt_documento_7" class="subirDocumento" accept=".pdf">
                                                <p class="help-block"><?php echo $t('forms.max_document_size'); ?> <?php echo $t('forms.document_mb_50'); ?></p>
                                            </div>
                                            <input type="hidden" id="cantidadDocumentos" name="cantidadDocumentos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-12">
                <!-- Default box -->
                <div class="card card-primary" id="cardSeguimiento">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $t('titles.information_follow_up'); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!--=====================================
                                BOTÓN PARA AGREGAR OBSERACIONES
                                ======================================-->
                                        <div class="form-group row">
                                            <button type="button" class="btn btn-default btnAgregarObservacion">Agregar
                                                Observaci&oacute;n</button>
                                            <input type="hidden" id="listaObservaciones" name="listaObservaciones">
                                        </div>
                                        <!--=====================================
                                TABLA DE OBSERVACIONES
                                ======================================-->
                                        <div class="form-group row nuevaObservacion">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <!-- ENTRADA PARA SELECCIONAR ESTADO BAYER -->
                                        <div class="form-group">
                                            <label for="txt_fecha_seguimiento" class="control-label"
                                                style="text-align: right;">SEGUIMIENTO SATIFACI&Oacute;N
                                                CLIENTE</label>
                                            <input type="date" class="form-control" id="txt_fecha_seguimiento"
                                                id="txt_fecha_seguimiento">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <!-- ENTRADA PARA SELECCIONAR ESTADO BAYER -->
                                        <div class="form-group">
                                            <label for="cbm_estado_bayer" class="control-label"
                                                style="text-align: right;">ESTATUS<font color="red"> *</font>
                                            </label>
                                            <select class="form-control cbm_estado_bayer" name="state"
                                                id="cbm_estado_bayer" style="width:100%;">
                                                <option value=""><?php echo $t('forms.select_option'); ?></option>
                                                <option value="ABIERTO">ABIERTO</option>
                                                <option value="NO INTERESADO">NO INTERESADO</option>
                                                <option value="INTERESADO">INTERESADO</option>
                                                <option value="CONTRATADO">CONTRATADO</option>
                                                <option value="CANCELADO">CANCELADO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a href="clientes-incendios-pymes"><button type="button" class="btn btn-default"
                                        data-dismiss="modal"><?php echo $t('buttons.cancel'); ?></button></a>
                                <button type="submit" class="btn btn-primary float-right"
                                    onclick="Modificar_Cliente()"><i
                                        class="fa fa-save"><b>&nbsp;<?php echo $t('buttons.save'); ?></b></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-footer -->
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
                    <h5 class="modal-title"><?php echo $t('common.clients_list'); ?></h5>
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
                                    <th style="text-align:center; width:10px">Cliente</th>
                                    <th style="text-align:center; width:10px">Cedula/Ruc</th>
                                    <th style="text-align:center; width:10px">Acci&oacute;n</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                    <h5 class="modal-title"><?php echo $t('titles.add_observation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                        <label for="txt_observacion" class="control-label" style="text-align: right;"><?php echo $t('common.observation'); ?>
                            <font color="red"> *</font>
                        </label>
                        <textarea class="form-control validarNumerosLetrasDecimal" id="txt_observacion"
                            name="txt_observacion" cols="20" rows="5"
                            placeholder="<?php echo $t('messages.enter_observation'); ?>"></textarea>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $t('buttons.exit'); ?></button>

                    <button type="submit" class="btn btn-primary" onclick="agregarNuevaObservacion()"><?php echo $t('buttons.save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL LISTAR CONTRATOS
======================================-->
<div id="modal_listar_contratos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('messages.list_documents'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabla_lista_contratos" class="table table-bordered table-striped dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center; width:10px">#</th>
                                <th style="text-align:center; width:10px">Documento</th>
                                <th style="text-align:center; width:10px">Fecha Registro</th>
                                <th style="text-align:center; width:10px">Estado</th>
                                <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalListarEmpleados" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">LISTA EMPLEADOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table id="tabla_lista_empleados" class="table table-bordered table-striped dt-responsive"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:10px">#</th>
                                    <th style="text-align:center; width:10px">Empleado</th>
                                    <th style="text-align:center; width:10px">Acci&oacute;n</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script type="text/javascript" src="/js/clientes-incendio-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
$(document).ready(function() {
    listar_empleados_para_seleccionar();
    listar_clientes_para_seleccionar();
    listar_combo_categoria();
    listar_combo_aseguradora();
    listar_combo_provincia();
    $("#modalAgregarObservacion").on('shown.bs.modal', function() {
        $("#txt_observacion").focus();
    });
    setTimeout(function() {
        cargar_datos_cliente();
    }, 1500);
});
</script>
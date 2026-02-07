<?php

require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

if ($_SESSION["S_ROL"] != "CLIENTE") {

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
<h1><?php echo $t('titles.ambulatory_credit_medical_assistance_pymes'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('titles.ambulatory_credit_medical_assistance_pymes'); ?></li>
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
                <!-- <h3 class="card-title">BIENVENIDO AL CONTENIDO DE CREDITOS AMBULATORIO - ASISTENCIA MEDICA INDIVIDUAL</h3> -->
                <div class="card-tools pull-right">
<button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;<?php echo $t('buttons.new_record'); ?>
                                </i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
                    class="table table-bordered table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
<th style="text-align:center; width:10px"><?php echo $t('titles.request_number_ambulatory'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.patient'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.diagnosis'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.creation_date'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.presented_expense'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.state'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.initial_document'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.observations'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.modification_date'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('titles.authorization_document'); ?></th>
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
MODAL MOSTRAR LAS OBSERVACIONES DEL REEMBOLSO
======================================-->
<div class="modal fade" id="modalObservaciones">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $t('titles.observations'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="listaObservaciones">
                <div class="row" id="todoObservaciones">

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--=====================================
MODAL INGRESAR NUEVO CREDITO AMBULATORIO
======================================-->
<div id="modalAgregarCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalNuevoCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('titles.new_ambulatory_credit'); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosCreditoAmbulatorio">
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_fecha_credito_ambulatorio" class="control-label"
                                style="text-align: right;">FECHA DEL PEDIDO
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_credito_ambulatorio"
                                id="txt_fecha_credito_ambulatorio" name="txt_fecha_credito_ambulatorio">
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_contrato_aplicar" class="control-label" style="text-align: right;"><?php echo $t('form.contract'); ?>
                                APLICAR
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="txt_contrato_aplicar"
                                    name="txt_contrato_aplicar" placeholder="CONTRATO" style="text-transform: uppercase"
                                    disabled>
                                <input type="hidden" id="txt_idBayer">
                                <input type="hidden" id="txt_idContrato">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary btnListarContratos"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="cbm_nombre_colaborador" class="control-label" style="text-align: right;"><?php echo $t('form.name'); ?>
                                COLABORADOR
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_nombre_colaborador js-example-basic-single" name="state"
                                id="cbm_nombre_colaborador" style="width:100%;">
                                <option value=""><?php echo $t('titles.no_records'); ?></option>
                            </select>
                            <input type="hidden" id="lista_colaboradores" name="lista_colaboradores">
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_nombre_paciente" class="control-label" style="text-align: right;"><?php echo $t('form.patient_name'); ?>
                                PACIENTE
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_nombre_paciente js-example-basic-single" name="state"
                                id="cbm_nombre_paciente" style="width:100%;">
                                <option value=""><?php echo $t('titles.no_records'); ?></option>
                            </select>
                        </div>
                        <!-- <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_presentado_credito_ambulatorio" class="control-label"
                                style="text-align: right;">VALOR AMBULATORIO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control valor_presentado validarNumerosDecimal"
                                    id="txt_valor_presentado_credito_ambulatorio"
                                    name="txt_valor_presentado_credito_ambulatorio" placeholder="0.00">
                            </div>
                        </div> -->
                        <div class="form-group col-12">
                            <label for="txt_diagnostico_credito_ambulatorio" class="control-label"
                                style="text-align: right;">DIAGNÓSTICO
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control diagnostico_credito_ambulatorio validarNumerosLetrasDecimal"
                                id="txt_diagnostico_credito_ambulatorio" name="txt_diagnostico_credito_ambulatorio"
                                cols="20" rows="2" placeholder="Ingresar Diagnostico"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_tipo_examen_credito_ambulatorio" class="control-label"
                                style="text-align: right;">TIPO DE EXAMEN
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control tipo_examen_credito_ambulatorio validarNumerosLetrasDecimal"
                                id="txt_tipo_examen_credito_ambulatorio" name="txt_tipo_examen_credito_ambulatorio"
                                cols="20" rows="2" placeholder="Ingresar Tipo de Examen"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_lugar_procedimiento_credito_ambulatorio" class="control-label"
                                style="text-align: right;">LUGAR DEL PROCEDIMIENTO
                                <font color="red"> *</font>
                            </label>
                            <textarea
                                class="form-control lugar_procedimiento_credito_ambulatorio validarNumerosLetrasDecimal"
                                id="txt_lugar_procedimiento_credito_ambulatorio"
                                name="txt_lugar_procedimiento_credito_ambulatorio" cols="20" rows="2"
                                placeholder="Ingresar Tipo de Examen"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_fecha_procedimiento_credito_ambulatorio" class="control-label"
                                style="text-align: right;">FECHA DEL PROCEDIMIENTO
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_procedimiento_credito_ambulatorio"
                                id="txt_fecha_procedimiento_credito_ambulatorio"
                                name="txt_fecha_procedimiento_credito_ambulatorio">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio" class="control-label"
                                style="text-align: right;">DOCUMENTOS
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_documento_credito_ambulatorio"
                                name="txt_documento_credito_ambulatorio" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_document_size'); ?> <?php echo $t('form.document_mb_25'); ?></p>
                        </div>
                        <input type="hidden" id="listaDatosCreditoAmbulatorio">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Registrar_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL LISTAR CONTRATOS CLIENTE
======================================-->
<div id="modalListarContratosClientes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('titles.contracts_list'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table id="table_listar_contratos_cliente"
                            class="table table-bordered table-striped dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:10px">#</th>
<th style="text-align:center; width:10px"><?php echo $t('list_tables.provider'); ?></th>
                                    <th style="text-align:center; width:10px"><?php echo $t('list_tables.plan'); ?></th>
                                    <th style="text-align:center; width:10px"><?php echo $t('list_tables.id_card'); ?></th>
                                    <th style="text-align:center; width:10px"><?php echo $t('list_tables.customer'); ?></th>
                                    <th style="text-align:center; width:10px"><?php echo $t('list_tables.contract_number'); ?></th>
                                    <th style="text-align:center; width:10px"><?php echo $t('list_tables.action'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/credito-ambulatorio-asistencia-medica-individual-cliente-empresarial.js?rev=<?php echo time(); ?>">
</script>
<script>
    $(document).ready(function() {
        listar_credito_ambulatorio_cliente_asistencia_medica_individual();
    });
</script>
<?php

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
                    <h1>Crédito Ambulatorio Asistencia Medica Individual
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Crédito Ambulatorio Asistencia Medica Individual</li>
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
                            class="fa fa-plus"><b>&nbsp;Nuevo
                                Registro</i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla-listar-creditos-ambulatorios-asistencia-medica-individual"
                    class="table table-bordered table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">N° Solicitud Credito Ambulatorio</th>
                            <th style="text-align:center; width:10px">Paciente</th>
                            <th style="text-align:center; width:10px">Diagnostico</th>
                            <th style="text-align:center; width:10px">Fecha Creaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Gasto Presentado</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Documento Inicial</th>
                            <th style="text-align:center; width:10px">Observaciones</th>
                            <th style="text-align:center; width:10px">Fecha Modificaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Documento Autorizaci&oacute;n</th>
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
                <h4 class="modal-title">Observaciones</h4>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalNuevoCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">NUEVO CRÉDITO AMBULATORIO</h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosCreditoAmbulatorio">
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_fecha_credito_ambulatorio" class="control-label"
                                style="text-align: right;">FECHA DEL PEDIDO
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_credito_ambulatorio"
                                id="txt_fecha_credito_ambulatorio" name="txt_fecha_credito_ambulatorio">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_contrato_aplicar" class="control-label" style="text-align: right;">CONTRATO
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
                        <div class="form-group col-12">
                            <label for="txt_nombre_paciente" class="control-label" style="text-align: right;">NOMBRE
                                PACIENTE
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_nombre_paciente js-example-basic-single" name="state"
                                id="cbm_nombre_paciente" style="width:100%;">
                                <option value="">SIN REGISTROS</option>
                            </select>
                        </div>
                        <!-- <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_presentado_credito_ambulatorio" class="control-label"
                                style="text-align: right;">VALOR AMBULATORIA
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
                            <p class="help-block">Peso máximo del documento 25MB</p>
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
                    <h5 class="modal-title">LISTA CONTRATOS</h5>
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
                                    <th style="text-align:center; width:10px">Proveedor</th>
                                    <th style="text-align:center; width:10px">Plan</th>
                                    <th style="text-align:center; width:10px">Cedula/Ruc</th>
                                    <th style="text-align:center; width:10px">Cliente</th>
                                    <th style="text-align:center; width:10px">Contrato</th>
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

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/creditos-ambulatorios-asistencia-medica-individual-cliente.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_creditos_ambulatorios_cliente_asistencia_medica_individual();
    });
</script>
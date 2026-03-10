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
                    <h1><?php echo $t('common.ambulatory_credit_medical_individual_pymes'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('common.ambulatory_credit_medical_individual_pymes'); ?></li>
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
                    class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px"><?php echo $t('form.ambulatory_credit_request'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.creation_date'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.patient'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.diagnosis'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.gasto_presentado'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.documento_inicial'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.envio_seguradora'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.observations'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.table_status'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.fecha_seguimiento'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.insurer_follow_up'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.requerimiento'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('form.requerimiento'); ?> 2</th>
                            <th style="text-align:center; width:10px"><?php echo $t('form.envio_seguradora'); ?> Requerimento</th>
                            <th style="text-align:center; width:10px"><?php echo $t('form.envio_seguradora'); ?> Requerimento 2</th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.fecha_autorizacion'); ?></th>
                            <th style="text-align:center; width:10px"<?php echo $t('form.documento_autorizacion'); ?></th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idCreditoAmbulatorio">
                <input type="hidden" id="txt_idContrato">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
MODAL LISTAR OBSERVACIONES CREDITO AMBULATORIO
======================================-->
<div class="modal fade" id="modalObservaciones">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Observaciones - <span id="ObservacionesPaciente"></span></h4>
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
MODAL VALIDAR MODIFICAR CREDITO AMBULATORIO
======================================-->
<div id="modalModificarCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalValidarDocumentosCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">REVISAR <?php echo $t('form.documents'); ?> CRÉDITO AMBULATORIOS PYMES - <span
                            id="modificarCreditoAmbulatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row validarDatosCreditoAmbulatorio">
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_solicitud" class="control-label"><?php echo $t('form.ambulatory_request'); ?>
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_1"
                                    id="radio_solicitud_1" value="SI">
                                <label class="form-check-label"><?php echo $t('form.yes'); ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_1"
                                    id="radio_solicitud_2" value="NO" checked>
                                <label class="form-check-label"><?php echo $t('form.no'); ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_1"
                                    id="radio_solicitud_3" value="N/A">
                                <label class="form-check-label"><?php echo $t('form.na'); ?></label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar1"
                                value="<?php echo $t('form.ambulatory_request'); ?>">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_pedido_examenes" class="control-label"><?php echo $t('form.exam_requests'); ?></label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_pedido_examenes_1" value="SI">
                                <label class="form-check-label"><?php echo $t('form.yes'); ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_pedido_examenes_2" value="NO" checked>
                                <label class="form-check-label"><?php echo $t('form.no'); ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_pedido_examenes_3" value="N/A">
                                <label class="form-check-label"><?php echo $t('form.na'); ?></label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar2"
                                value="PEDIDOS DE EXÁMENES">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_pedido_rehabilitacion" class="control-label">PEDIDOS DE
                                REHABILITACI&Oacute;N<font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_pedido_rehabilitacion_1" value="SI">
                                <label class="form-check-label"><?php echo $t('form.yes'); ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_pedido_rehabilitacion_2" value="NO" checked>
                                <label class="form-check-label"><?php echo $t('form.no'); ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_pedido_rehabilitacion_3" value="N/A">
                                <label class="form-check-label"><?php echo $t('form.na'); ?></label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar3"
                                value="PEDIDOS DE EXÁMENES">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_fecha_seguimiento_validar" class="control-label"
                                style="text-align: right;">FECHA
                                SEGUIMIENTO
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_seguimiento_validar"
                                id="txt_fecha_seguimiento_validar" name="txt_fecha_seguimiento_validar">
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_credito_ambulatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_credito_ambulatorio validarNumerosLetrasDecimal"
                                id="txt_observaciones_credito_ambulatorio" name="txt_observaciones_credito_ambulatorio"
                                cols="20" rows="4" placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                        </div>
                        <input type="hidden" id="listaValidarDatosCreditoAmbulatorio">
                        <input type="hidden" id="listaObservacionesDatosCreditoAmbulatorio">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Validar_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR OBSERVACION ADICIONAL CREDITO AMBULATORIO
======================================-->
<div id="modalAgregarObservacionAdicionalCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR OBSERVACIONES AL CRÉDITO AMBULATORIO PYMES - <span
                            id="agregarObservacionAdicionalCreditoAmbulatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_fecha_seguimiento_observacion_adicional" class="control-label"
                                style="text-align: right;">FECHA
                                SEGUIMIENTO CLIENTE Y/O ASEGURADORA
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control" id="txt_fecha_seguimiento_observacion_adicional"
                                name="txt_fecha_seguimiento_observacion_adicional">
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_adicionales_seguimiento_credito_ambulatorio"
                                class="control-label" style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea
                                class="form-control observaciones_adicionales_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_adicionales_seguimiento_credito_ambulatorio"
                                name="txt_observaciones_adicionales_seguimiento_credito_ambulatorio" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosCreditoAmbulatorio">
                            <input type="hidden"
                                id="listaObservacionesAdicionalesSeguimientosCreditoAmbulatorioAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_adicionales_Seguimiento_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--=====================================
MODAL AGREGAR SEGUIMIENTO CREDITO AMBULATORIO
======================================-->
<div id="modalAgregarSeguimientoCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.add_follow_up_credit'); ?> - <span
                            id="agregarSeguimientoCreditoAmbulatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <!--=====================================
                                BOTÓN PARA AGREGAR DEPENDIENTE
                                ======================================-->
                    <div class="form-group row">
                        <button type="button" class="btn btn-default btnAgregarDocumentoRequeridoAseguradora">Agregar
                            Documento</button>
                        <input type="hidden" id="listaDocumentosSolicitadosAseguradora"
                            name="listaDocumentosSolicitadosAseguradora">
                        <input type="hidden" id="listaDocumentosSolicitadosAseguradoraAnterior"
                            name="listaDocumentosSolicitadosAseguradoraAnterior">
                    </div>
                    <div class="row seguimientoDatosCreditoAmbulatorio">

                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="enviarEmail" name="enviarEmail" type="checkbox"
                                    checked>
                                <label class="form-check-label"><?php echo $t('form.send_email'); ?></label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_fecha_seguimiento" class="control-label" style="text-align: right;">FECHA
                                SEGUIMIENTO CLIENTE
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_seguimiento" id="txt_fecha_seguimiento"
                                name="txt_fecha_seguimiento">
                        </div>
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="estadoCaducado" name="estadoCaducado"
                                    type="checkbox">
                                <label class="form-check-label"><?php echo $t('form.expired_status'); ?></label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_seguimiento_credito_ambulatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_credito_ambulatorio"
                                name="txt_observaciones_seguimiento_credito_ambulatorio" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosCreditoAmbulatorio">
                            <input type="hidden" id="listaObservacionesSeguimientosCreditoAmbulatorioAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio_documento_pedido_aseguradora"
                                class="control-label" style="text-align: right;"><?php echo $t('form.documents'); ?> ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_credito_ambulatorio_documento_pedido_aseguradora"
                                name="txt_documento_credito_ambulatorio_documento_pedido_aseguradora" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_doc_25mb'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Seguimiento_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR SEGUIMIENTO CREDITO AMBULATORIO 1
======================================-->
<div id="modalAgregarSeguimientoCreditoAmbulatorio1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoCreditoAmbulatorio1">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.add_follow_up_credit'); ?> - <span
                            id="agregarSeguimientoCreditoAmbulatorioPaciente1"></span></h5>
                </div>
                <div class="modal-body">
                    <!--=====================================
                                BOTÓN PARA AGREGAR DEPENDIENTE
                                ======================================-->
                    <div class="form-group row">
                        <button type="button" class="btn btn-default btnAgregarDocumentoRequeridoAseguradora1">Agregar
                            Documento</button>
                        <input type="hidden" id="listaDocumentosSolicitadosAseguradora1"
                            name="listaDocumentosSolicitadosAseguradora1">
                        <input type="hidden" id="listaDocumentosSolicitadosAseguradoraAnterior1"
                            name="listaDocumentosSolicitadosAseguradoraAnterior1">
                    </div>
                    <div class="row seguimientoDatosCreditoAmbulatorio1">

                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="enviarEmail1" name="enviarEmail1" type="checkbox"
                                    checked>
                                <label class="form-check-label"><?php echo $t('form.send_email'); ?></label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_fecha_seguimiento1" class="control-label" style="text-align: right;">FECHA
                                SEGUIMIENTO CLIENTE
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_seguimiento" id="txt_fecha_seguimiento1"
                                name="txt_fecha_seguimiento1">
                        </div>
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="estadoCaducado1" name="estadoCaducado1"
                                    type="checkbox">
                                <label class="form-check-label"><?php echo $t('form.expired_status'); ?></label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_seguimiento_credito_ambulatorio1" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento1 validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_credito_ambulatorio1"
                                name="txt_observaciones_seguimiento_credito_ambulatorio1" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosCreditoAmbulatorio1">
                            <input type="hidden" id="listaObservacionesSeguimientosCreditoAmbulatorioAnterior1">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio_documento_pedido_aseguradora1"
                                class="control-label" style="text-align: right;"><?php echo $t('form.documents'); ?> ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_credito_ambulatorio_documento_pedido_aseguradora1"
                                name="txt_documento_credito_ambulatorio_documento_pedido_aseguradora1" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_doc_25mb'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Seguimiento_Credito_Ambulatorio_1()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO CREDITO AMBULATORIO
======================================-->
<div id="modalAgregarDocumentoSeguimientoCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.add_additional_documents_credit'); ?> - <span
                            id="agregarDocumentoSeguimientoCreditoAmbulatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_fecha_documento_seguimiento_aseguradora" class="control-label"
                                style="text-align: right;">FECHA
                                SEGUIMIENTO ASEGURADORA
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control txt_fecha_documento_seguimiento_aseguradora"
                                id="txt_fecha_documento_seguimiento_aseguradora"
                                name="txt_fecha_documento_seguimiento_aseguradora">
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_documento_seguimiento_credito_ambulatorio"
                                class="control-label" style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_credito_ambulatorio"
                                name="txt_observaciones_documento_seguimiento_credito_ambulatorio" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosCreditoAmbulatorio">
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio_documento_seguimiento" class="control-label"
                                style="text-align: right;"><?php echo $t('form.documents'); ?> ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_credito_ambulatorio_documento_seguimiento"
                                name="txt_documento_credito_ambulatorio_documento_seguimiento" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_doc_25mb'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO CREDITO AMBULATORIO 1
======================================-->
<div id="modalAgregarDocumentoSeguimientoCreditoAmbulatorio1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoCreditoAmbulatorio1">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.add_additional_documents_credit'); ?> - <span
                            id="agregarDocumentoSeguimientoCreditoAmbulatorioPaciente1"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_fecha_documento_seguimiento_aseguradora1" class="control-label"
                                style="text-align: right;">FECHA
                                SEGUIMIENTO ASEGURADORA
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control txt_fecha_documento_seguimiento_aseguradora1"
                                id="txt_fecha_documento_seguimiento_aseguradora1"
                                name="txt_fecha_documento_seguimiento_aseguradora1">
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_documento_seguimiento_credito_ambulatorio1"
                                class="control-label" style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento1 validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_credito_ambulatorio1"
                                name="txt_observaciones_documento_seguimiento_credito_ambulatorio1" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosCreditoAmbulatorio1">
                            <input type="hidden"
                                id="listaObservacionesDocumentoSeguimientosCreditoAmbulatorioAnterior1">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio_documento_seguimiento1" class="control-label"
                                style="text-align: right;"><?php echo $t('form.documents'); ?> ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_credito_ambulatorio_documento_seguimiento1"
                                name="txt_documento_credito_ambulatorio_documento_seguimiento1" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_doc_25mb'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Credito_Ambulatorio_1()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR AUTORIZACION PEDIDO CREDITO AMBULATORIO
======================================-->
<div id="modalAgregarDocumentoAutorizacionCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoAutorizacionCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.add_authorization'); ?> - <span
                            id="agregarDocumentoAutorizacionCreditoAmbulatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="txt_idBayer">
                        <input type="hidden" id="listaDependientes">
                        <div class="form-group col-12">
                            <label for="txt_paciente_credito_ambulatorio" class="control-label"
                                style="text-align: right;"><?php echo $t('form.patient_credit'); ?>
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control validarNumerosLetrasDecimal txt_paciente_credito_ambulatorio"
                                    id="txt_paciente_credito_ambulatorio" name="txt_paciente_credito_ambulatorio"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_autorizacion_credito_ambulatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_autorizacion_credito_ambulatorio"
                                name="txt_observaciones_autorizacion_credito_ambulatorio" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesAutorizacionCreditoAmbulatorio">
                            <input type="hidden" id="listaObservacionesAutorizacionCreditoAmbulatorioAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio_documento_autorizacion" class="control-label"
                                style="text-align: right;"><?php echo $t('form.documents'); ?> AUTORIZACI&Oacute;N
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_credito_ambulatorio_documento_autorizacion"
                                name="txt_documento_credito_ambulatorio_documento_autorizacion" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_doc_25mb'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Autorizacion_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR OBSERVACION ANULACION AMBULATORIO
======================================-->
<div id="modalAgregarObservacionAnulacionAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.add_cancellation_credit'); ?> - <span
                            id="agregarObservacionAnulacionAmbulatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_anulacion_ambulatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_anulacion validarNumerosLetrasDecimal"
                                id="txt_observaciones_anulacion_ambulatorio"
                                name="txt_observaciones_anulacion_ambulatorio" cols="20" rows="4"
                                placeholder="<?php echo $t('form.enter_comments'); ?>"></textarea>
                            <input type="hidden" id="listaObservacionesAnulacionAmbulatorio">
                            <input type="hidden" id="listaObservacionesAnulacionAmbulatorioAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_Anulacion_Credito_Ambulatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL INGRESAR NUEVO CREDITO AMBULATORIO
======================================-->
<div id="modalAgregarCreditoAmbulatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalNuevoCreditoAmbulatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('form.new_ambulatory_credit'); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosCreditoAmbulatorio">
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_fecha_credito_ambulatorio" class="control-label"
                                style="text-align: right;"><?php echo $t('form.order_date'); ?>
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_credito_ambulatorio"
                                id="txt_fecha_credito_ambulatorio" name="txt_fecha_credito_ambulatorio">
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_contrato_aplicar" class="control-label" style="text-align: right;">CONTRATO
                                APLICAR
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="txt_contrato_aplicar"
                                    name="txt_contrato_aplicar" placeholder="<?php echo $t('form.contract'); ?>" style="text-transform: uppercase"
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
                            <label for="cbm_nombre_colaborador" class="control-label" style="text-align: right;">NOMBRE
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
                            <label for="txt_nombre_paciente" class="control-label" style="text-align: right;">NOMBRE
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
                                style="text-align: right;"><?php echo $t('form.ambulatory_value'); ?>
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
                                style="text-align: right;"><?php echo $t('form.diagnosis'); ?>
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control diagnostico_credito_ambulatorio validarNumerosLetrasDecimal"
                                id="txt_diagnostico_credito_ambulatorio" name="txt_diagnostico_credito_ambulatorio"
                                cols="20" rows="2" placeholder="<?php echo $t('form.enter_diagnosis'); ?>"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_tipo_examen_credito_ambulatorio" class="control-label"
                                style="text-align: right;"><?php echo $t('form.exam_type'); ?>
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control tipo_examen_credito_ambulatorio validarNumerosLetrasDecimal"
                                id="txt_tipo_examen_credito_ambulatorio" name="txt_tipo_examen_credito_ambulatorio"
                                cols="20" rows="2" placeholder="Ingresar Tipo de Examen"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_lugar_procedimiento_credito_ambulatorio" class="control-label"
                                style="text-align: right;"><?php echo $t('form.procedure_place'); ?>
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
                                style="text-align: right;"><?php echo $t('form.procedure_date'); ?>
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_procedimiento_credito_ambulatorio"
                                id="txt_fecha_procedimiento_credito_ambulatorio"
                                name="txt_fecha_procedimiento_credito_ambulatorio">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_credito_ambulatorio" class="control-label"
                                style="text-align: right;"><?php echo $t('form.documents'); ?>
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_documento_credito_ambulatorio"
                                name="txt_documento_credito_ambulatorio" accept=".pdf">
                            <p class="help-block"><?php echo $t('form.max_doc_25mb'); ?></p>
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
                    <h5 class="modal-title"><?php echo $t('titles.contract_list'); ?></h5>
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
                                    <th style="text-align:center; width:10px"<?php echo $t('form.provider'); ?></th>
                                    <th style="text-align:center; width:10px"<?php echo $t('form.plan'); ?></th>
                                    <th style="text-align:center; width:10px"<?php echo $t('form.table_document'); ?></th>
                                    <th style="text-align:center; width:10px"<?php echo $t('form.table_client'); ?></th>
                                    <th style="text-align:center; width:10px"<?php echo $t('form.table_contract'); ?></th>
                                    <th style="text-align:center; width:10px"<?php echo $t('form.table_action'); ?></th>
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
<script type="text/javascript" src="/js/creditos-ambulatorios-asistencia-medica-individual-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_creditos_ambulatorios_asistencia_medica_individual();
    });
</script>
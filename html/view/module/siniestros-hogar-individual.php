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
                <div class="col-sm-6">
                    <h1>Siniestros Hogar Individual
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Siniestros Hogar Individual</li>
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
                <table id="tabla-listar-siniestros-hogar-individual" class="table table-bordered table-striped"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">N° Siniestro</th>
                            <th style="text-align:center; width:10px">Fecha Siniestro</th>
                            <th style="text-align:center; width:10px">Fecha Creaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Cliente</th>
                            <th style="text-align:center; width:10px">Daños Terceros</th>
                            <th style="text-align:center; width:10px">Documento Inicial</th>
                            <th style="text-align:center; width:10px">Envio Aseguradora</th>
                            <th style="text-align:center; width:10px">Observaciones</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Fecha Seguimiento</th>
                            <th style="text-align:center; width:10px">Seguimiento Aseguradora</th>
                            <th style="text-align:center; width:10px">Requerimiento por la aseguradora</th>
                            <th style="text-align:center; width:10px">Envio Requerimiento Aseguradora</th>
                            <th style="text-align:center; width:10px">Valor Deducible</th>
                            <th style="text-align:center; width:10px">Valor RASA</th>
                            <th style="text-align:center; width:10px">Valor Cubierto</th>
                            <th style="text-align:center; width:10px">Valor Pago Cliente</th>
                            <th style="text-align:center; width:10px">Fecha Liquidaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Liquidaci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idSiniestro">
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
MODAL LISTAR OBSERVACIONES REEMBOLSO
======================================-->
<div class="modal fade" id="modalObservaciones">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Observaciones - <span id="modalObservacionesSiniestroHogar"></span></h4>
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
MODAL VALIDAR MODIFICAR REEMBOLSO
======================================-->
<div id="modalModificarSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalValidarDocumentosSiniestro">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">REVISAR DOCUMENTOS SINIESTRO - <span
                            id="modalModificarSiniestroHogar"></span></h5>
                </div>
                <div class="modal-body">

                    <div class="row validarDatosSiniestro">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Documentos Cliente</h3>
                                </div>
                                <div class="card-body">
                                    <div class=" row">
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_formulario_siniestro" class="control-label">FORMULARIO
                                                SINIESTRO
                                                <font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_1" id="radio_formulario_siniestro_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_1" id="radio_formulario_siniestro_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_1" id="radio_formulario_siniestro_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar1"
                                                value="FORMULARIO SINIESTRO">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_cedula_dueno_auto" class="control-label">CEDULA DUEÑO AUTO
                                                <font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_2" id="radio_cedula_dueno_auto_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_2" id="radio_cedula_dueno_auto_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_2" id="radio_cedula_dueno_auto_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar2"
                                                value="CEDULA DUENO AUTO">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_licencia" class="control-label">LICENCIA CONDUCTOR<font
                                                    color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_3" id="radio_licencia_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_3" id="radio_licencia_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_3" id="radio_licencia_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar3"
                                                value="LICENCIA CONDUCTOR">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_matricula" class="control-label">MATRICULA
                                                <font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_4" id="radio_matricula_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_4" id="radio_matricula_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_4" id="radio_matricula_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar4"
                                                value="MATRICULA">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_parte_policial" class="control-label">PARTE POLICIAL<font
                                                    color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_5" id="radio_parte_policial_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_5" id="radio_parte_policial_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_5" id="radio_parte_policial_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar5"
                                                value="PARTE POLICIAL">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_denuncia_fiscalia" class="control-label">DENUNCIA FISCALIA
                                                <font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_6" id="radio_denuncia_fiscalia_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_6" id="radio_denuncia_fiscalia_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_6" id="radio_denuncia_fiscalia_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar6"
                                                value="DENUNCIA FISCALIA">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_denuncia_fiscalia" class="control-label">FOTOS AUTO
                                                AFECTADO<font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_7" id="radio_foto_auto_afectado_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_7" id="radio_foto_auto_afectado_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_7" id="radio_foto_auto_afectado_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar7"
                                                value="FOTOS AUTO AFECTADO">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Documentos Daños Terceros</h3>
                                </div>
                                <div class="card-body">
                                    <div class=" row">
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_licencia_terceros" class="control-label">LICENCIA TERCEROS
                                                <font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_8" id="radio_licencia_terceros_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_8" id="radio_licencia_terceros_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_8" id="radio_licencia_terceros_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar8"
                                                value="LICENCIA TERCEROS">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_matricula_terceros" class="control-label">MATRICULA
                                                <font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_9" id="radio_matricula_terceros_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_9" id="radio_matricula_terceros_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_9" id="radio_matricula_terceros_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar9"
                                                value="MATRICULA TERCEROS">
                                        </div>
                                        <div class="form-group col-12 col-lg-3 col-md-4">
                                            <label for="radio_fotos_auto_terceros" class="control-label">FOTOS AUTO
                                                TERCEROS<font color="red"> *</font>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_10" id="radio_fotos_auto_terceros_1" value="SI">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_10" id="radio_fotos_auto_terceros_2" value="NO" checked>
                                                <label class="form-check-label">NO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio_validacion" type="radio"
                                                    name="radio_10" id="radio_fotos_auto_terceros_3" value="N/A">
                                                <label class="form-check-label">N/A</label>
                                            </div>
                                            <input type="hidden" class="etiquetaRadioValidar"
                                                id="etiquetaRadioValidar10" value="FOTOS AUTO TERCEROS">
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                            <label for=" txt_observaciones_siniestro" class="control-label" style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_siniestro validarNumerosLetrasDecimal"
                                id="txt_observaciones_siniestro" name="txt_observaciones_siniestro" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                        </div>
                        <input type="hidden" id="listaValidarDatosSiniestro">
                        <input type="hidden" id="listaObservacionesDatosSiniestro">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Validar_Siniestro()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR OBSERVACION ADICIONAL SINIESTRO
======================================-->
<div id="modalAgregarObservacionAdicionalSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR OBSERVACIONES AL SINIESTRO - <span
                            id="modalModificarSiniestroHogar"></span></h5>
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
                            <label for=" txt_observaciones_adicionales_seguimiento_siniestro" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea
                                class="form-control observaciones_adicionales_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_adicionales_seguimiento_siniestro"
                                name="txt_observaciones_adicionales_seguimiento_siniestro" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosSiniestro">
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosSiniestroAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_adicionales_Seguimiento_Siniestro()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--=====================================
MODAL AGREGAR SEGUIMIENTO SINIESTRO
======================================-->
<div id="modalAgregarSeguimientoSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoSiniestro">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR SEGUIMIENTO AL SINIESTRO - <span
                            id="modalModificarSiniestroHogar"></span></h5>
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
                    <div class="row seguimientoDatosSiniestro">

                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="enviarEmail" name="enviarEmail" type="checkbox"
                                    checked>
                                <label class="form-check-label">Enviar Email</label>
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
                            <label for=" txt_observaciones_seguimiento_siniestro" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_siniestro"
                                name="txt_observaciones_seguimiento_siniestro" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosSiniestro">
                            <input type="hidden" id="listaObservacionesSeguimientosSiniestroAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Seguimiento_Siniestro()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO SINIESTRO
======================================-->
<div id="modalAgregarDocumentoSeguimientoSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoSiniestro">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO ADICIONALES AL SINIESTRO - <span
                            id="modalAgregarDocumentoSeguimientoSiniestroHogar"></span></h5>
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
                            <label for=" txt_observaciones_documento_seguimiento_siniestro" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_siniestro"
                                name="txt_observaciones_documento_seguimiento_siniestro" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosSiniestro">
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosSiniestroAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_siniestro_documento_seguimiento" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_siniestro_documento_seguimiento"
                                name="txt_documento_siniestro_documento_seguimiento" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Siniestro()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR LIQUIDACION SINIESTRO
======================================-->
<div id="modalAgregarDocumentoLiquidacionSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoLiquidacionSiniestro">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO LIQUIDACION AL SINIESTRO - <span
                            id="modalAgregarDocumentoLiquidacionSiniestroHogar"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="txt_idBayer">
                        <input type="hidden" id="listaHogares">
                        <div class="form-group col-12">
                            <label for="txt_paciente_siniestro" class="control-label" style="text-align: right;">HOGAR
                                SINIESTRADO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetrasDecimal txt_hogar_siniestro"
                                    id="txt_hogar_siniestro" name="txt_hogar_siniestro" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_deducible" class="control-label" style="text-align: right;">VALOR
                                DEDUCIBLE
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal" id="txt_valor_deducible"
                                    name="txt_valor_deducible" value="0">
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_rasa" class="control-label" style="text-align: right;">VALOR RASA
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal" id="txt_valor_rasa"
                                    name="txt_valor_rasa" value="0">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_cubierto" class="control-label" style="text-align: right;">VALOR
                                CUBIERTO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal" id="txt_valor_cubierto"
                                    name="txt_valor_cubierto" value="0">
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_paga_cliente" class="control-label" style="text-align: right;">VALOR
                                PAGA CLIENTE
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal"
                                    id="txt_valor_paga_cliente" name="txt_valor_paga_cliente" value="0">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_liquidacion_siniestro" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_liquidacion_siniestro"
                                name="txt_observaciones_liquidacion_siniestro" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesLiquidacionSiniestro">
                            <input type="hidden" id="listaObservacionesLiquidacionSiniestroAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_siniestro_documento_liquidacion" class="control-label"
                                style="text-align: right;">DOCUMENTOS LIQUIDACI&Oacute;N
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_siniestro_documento_liquidacion"
                                name="txt_documento_siniestro_documento_liquidacion" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Liquidacion_Siniestro()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR OBSERVACION ANULACION SINIESTRO
======================================-->
<div id="modalAgregarObservacionAnulacionSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR ANULACIÓN AL SINIESTRO HOGAR - <span
                            id="modalAgregarObservacionAnulacionSiniestroHogar"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_anulacion_siniestro" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_anulacion validarNumerosLetrasDecimal"
                                id="txt_observaciones_anulacion_siniestro" name="txt_observaciones_anulacion_siniestro"
                                cols="20" rows="4" placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAnulacionSiniestro">
                            <input type="hidden" id="listaObservacionesAnulacionSiniestroAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_Anulacion_Siniestro()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/siniestros-hogar-individual.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_siniestros_hogar_individual();
    });
</script>
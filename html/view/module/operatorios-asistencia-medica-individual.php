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
                    <h1>Crédito Hopitalario Asistencia Medica Individual
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Crédito Hopitalario Asistencia Medica Individual</li>
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
                <!-- <h3 class="card-title">BIENVENIDO AL CONTENIDO DE OPERATORIOS - ASISTENCIA MEDICA INDIVIDUAL</h3> -->
                <div class="card-tools pull-right">
                    <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;Nuevo
                                Registro</i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla-listar-operatorios-asistencia-medica-individual"
                    class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">N° Solicitud Operatorio</th>
                            <th style="text-align:center; width:10px">Fecha Creaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Paciente</th>
                            <th style="text-align:center; width:10px">Diagnostico</th>
                            <th style="text-align:center; width:10px">Gasto Presentado</th>
                            <th style="text-align:center; width:10px">Documento Inicial</th>
                            <th style="text-align:center; width:10px">Envio Aseguradora</th>
                            <th style="text-align:center; width:10px">Observaciones</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Fecha Seguimiento</th>
                            <th style="text-align:center; width:10px">Seguimiento Aseguradora</th>
                            <th style="text-align:center; width:10px">Requerimiento por la aseguradora</th>
                            <th style="text-align:center; width:10px">Requerimiento por la aseguradora 2</th>
                            <th style="text-align:center; width:10px">Envio Requerimiento Aseguradora</th>
                            <th style="text-align:center; width:10px">Envio Requerimiento Aseguradora 2</th>
                            <th style="text-align:center; width:10px">Fecha Autorizaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Documento Autorizaci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idOperatorio">
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
MODAL LISTAR OBSERVACIONES OPERATORIO
======================================-->
<div class="modal fade" id="modalObservaciones">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Observaciones - <span id="observacionesPaciente"></span></h4>
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
MODAL VALIDAR MODIFICAR OPERATORIO
======================================-->
<div id="modalModificarOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalValidarDocumentosOperatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">VALIDAR DOCUMENTOS CRÉDITO HOSPITALARIO - <span
                            id="modificarOperatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row validarDatosOperatorio">
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_solicitud" class="control-label">SOLICITUD HOSPITALARIO
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_1"
                                    id="radio_solicitud_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_1"
                                    id="radio_solicitud_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_1"
                                    id="radio_solicitud_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar1"
                                value="SOLICITUD HOSPITALARIO">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_resultado_examenes" class="control-label">RESULTADOS DE EXAMENES<font
                                    color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_resultado_examenes_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_resultado_examenes_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_resultado_examenes_2" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar2"
                                value="RESULTADOS DE EXÁMENES">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_historia_clinica" class="control-label">HISTORIA CLÍNICA<font color="red">
                                    *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_historia_clinica_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_historia_clinica_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_historia_clinica_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar3"
                                value="HISTORIA CLÍNICA">
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
                            <label for=" txt_observaciones_operatorio" class="control-label" style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_operatorio validarNumerosLetrasDecimal"
                                id="txt_observaciones_operatorio" name="txt_observaciones_operatorio" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                        </div>
                        <input type="hidden" id="listaValidarDatosOperatorio">
                        <input type="hidden" id="listaObservacionesDatosOperatorio">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Validar_Operatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR OBSERVACION ADICIONAL OPERATORIO
======================================-->
<div id="modalAgregarObservacionAdicionalOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR OBSERVACIONES AL CRÉDITO HOSPITALARIO - <span
                            id="agregarObservacionAdicionalOperatorioPaciente"></span></h5>
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
                            <label for=" txt_observaciones_adicionales_seguimiento_operatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea
                                class="form-control observaciones_adicionales_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_adicionales_seguimiento_operatorio"
                                name="txt_observaciones_adicionales_seguimiento_operatorio" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosOperatorio">
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosOperatorioAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_adicionales_Seguimiento_Operatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--=====================================
MODAL AGREGAR SEGUIMIENTO OPERATORIO
======================================-->
<div id="modalAgregarSeguimientoOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoOperatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR SEGUIMIENTO AL CRÉDITO HOSPITALARIO - <span
                            id="agregarSeguimientoOperatorioPaciente"></span></h5>
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
                    <div class="row seguimientoDatosOperatorio">

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
                            <div class="form-check">
                                <input class="form-check-input" id="estadoCaducado" name="estadoCaducado"
                                    type="checkbox">
                                <label class="form-check-label">Estado Caducado</label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_seguimiento_operatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_operatorio"
                                name="txt_observaciones_seguimiento_operatorio" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosOperatorio">
                            <input type="hidden" id="listaObservacionesSeguimientosOperatorioAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_operatorio_documento_pedido_aseguradora" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_operatorio_documento_pedido_aseguradora"
                                name="txt_documento_operatorio_documento_pedido_aseguradora" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Seguimiento_Operatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR SEGUIMIENTO OPERATORIO
======================================-->
<div id="modalAgregarSeguimientoOperatorio1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoOperatorio1">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR SEGUIMIENTO AL CRÉDITO HOSPITALARIO - <span
                            id="agregarSeguimientoOperatorioPaciente1"></span></h5>
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
                    <div class="row seguimientoDatosOperatorio1">

                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="enviarEmail1" name="enviarEmail1" type="checkbox"
                                    checked>
                                <label class="form-check-label">Enviar Email</label>
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
                                <label class="form-check-label">Estado Caducado</label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_seguimiento_operatorio1" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_operatorio1"
                                name="txt_observaciones_seguimiento_operatorio1" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosOperatorio1">
                            <input type="hidden" id="listaObservacionesSeguimientosOperatorioAnterior1">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_operatorio_documento_pedido_aseguradora1" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_operatorio_documento_pedido_aseguradora1"
                                name="txt_documento_operatorio_documento_pedido_aseguradora1" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Seguimiento_Operatorio_1()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO OPERATORIO
======================================-->
<div id="modalAgregarDocumentoSeguimientoOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoOperatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO ADICIONALES AL CRÉDITO HOSPITALARIO - <span
                            id="agregarDocumentoOperatorioPaciente"></span></h5>
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
                            <label for=" txt_observaciones_documento_seguimiento_operatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_operatorio"
                                name="txt_observaciones_documento_seguimiento_operatorio" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosOperatorio">
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosOperatorioAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_operatorio_documento_seguimiento" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_operatorio_documento_seguimiento"
                                name="txt_documento_operatorio_documento_seguimiento" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Operatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO OPERATORIO
======================================-->
<div id="modalAgregarDocumentoSeguimientoOperatorio1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoOperatorio1">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO ADICIONALES AL CRÉDITO HOSPITALARIO - <span
                            id="agregarDocumentoOperatorioPaciente1"></span></h5>
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
                            <label for=" txt_observaciones_documento_seguimiento_operatorio1" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_operatorio1"
                                name="txt_observaciones_documento_seguimiento_operatorio1" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosOperatorio1">
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosOperatorioAnterior1">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_operatorio_documento_seguimiento1" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_operatorio_documento_seguimiento1"
                                name="txt_documento_operatorio_documento_seguimiento1" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Operatorio1()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR AUTORIZACION PEDIDO OPERATORIO
======================================-->
<div id="modalAgregarDocumentoAutorizacionOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoAutorizacionReembolso">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO AUTORIZACI&Oacute;N - CRÉDITO HOSPITALARIO - <span
                            id="agregarDocumentoAutorizacionOperatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="txt_idBayer">
                        <input type="hidden" id="listaDependientes">
                        <div class="form-group col-12">
                            <label for="txt_paciente_reembolso" class="control-label"
                                style="text-align: right;">PACIENTE OPERATORIO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control validarNumerosLetrasDecimal txt_paciente_operatorio"
                                    id="txt_paciente_operatorio" name="txt_paciente_operatorio" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_autorizacion_operatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_autorizacion_operatorio"
                                name="txt_observaciones_autorizacion_operatorio" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAutorizacionOperatorio">
                            <input type="hidden" id="listaObservacionesAutorizacionOperatorioAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_operatorio_documento_autorizacion" class="control-label"
                                style="text-align: right;">DOCUMENTOS AUTORIZACI&Oacute;N
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_operatorio_documento_autorizacion"
                                name="txt_documento_operatorio_documento_autorizacion" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Autorizacion_Operatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR OBSERVACION ANULACION OPERATORIO
======================================-->
<div id="modalAgregarObservacionAnulacionOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR ANULACIÓN AL CRÉDITO HOSPITALARIO - <span
                            id="agregarObservacionAnulacionOperatorioPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_anulacion_operatorio" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_anulacion validarNumerosLetrasDecimal"
                                id="txt_observaciones_anulacion_operatorio"
                                name="txt_observaciones_anulacion_operatorio" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAnulacionOperatorio">
                            <input type="hidden" id="listaObservacionesAnulacionOperatorioAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_Anulacion_Operatorio()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL INGRESAR NUEVO OPERATORIO
======================================-->
<div id="modalAgregarOperatorio" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content" id="modalNuevoOperatorio">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">NUEVO CRÉDITO HOSPITALARIO</h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosOperatorio">
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_fecha_operacion" class="control-label" style="text-align: right;">FECHA
                                DE OPERACIÓN
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_operacion" id="txt_fecha_operacion"
                                name="txt_fecha_operacion">
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
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_nombre_paciente" class="control-label" style="text-align: right;">NOMBRE
                                PACIENTE
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_nombre_paciente js-example-basic-single" name="state"
                                id="cbm_nombre_paciente" style="width:100%;">
                                <option value="">SIN REGISTROS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_lugar_hospitalario_operatorio" class="control-label"
                                style="text-align: right;">LUGAR DE HOSPITALIZACIÓN
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control lugar_hospitalario"
                                    id="txt_lugar_hospitalario_operatorio" name="txt_lugar_hospitalario_operatorio">
                            </div>
                        </div>
                        <!-- <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_presentado_operatorio" class="control-label" style="text-align: right;">VALOR OPERATORIO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control valor_presentado validarNumerosDecimal" id="txt_valor_presentado_operatorio" name="txt_valor_presentado_operatorio" placeholder="0.00">
                            </div>
                        </div> -->
                        <div class="form-group col-12">
                            <label for="txt_diagnostico_operatorio" class="control-label"
                                style="text-align: right;">DIAGNÓSTICO
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control diagnostico_operatorio validarNumerosLetrasDecimal"
                                id="txt_diagnostico_operatorio" name="txt_diagnostico_operatorio" cols="20" rows="2"
                                placeholder="Ingresar Diagnostico"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_lugar_procedimiento_operatorio" class="control-label"
                                style="text-align: right;">LUGAR DEL PROCEDIMIENTO
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control lugar_procedimiento_operatorio validarNumerosLetrasDecimal"
                                id="txt_lugar_procedimiento_operatorio" name="txt_lugar_procedimiento_operatorio"
                                cols="20" rows="2" placeholder="Ingresar el lugar del procedimiento"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_fecha_procedimiento_operatorio" class="control-label"
                                style="text-align: right;">FECHA DEL PROCEDIMIENTO
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_procedimiento_operatorio"
                                id="txt_fecha_procedimiento_operatorio" name="txt_fecha_procedimiento_operatorio">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_operatorio" class="control-label"
                                style="text-align: right;">DOCUMENTOS
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_documento_operatorio"
                                name="txt_documento_operatorio" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>
                        <input type="hidden" id="listaDatosOperatorio">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Registrar_Operatorio()"><i
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
<script src="js/operatorios-asistencia-medica-individual.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_operatorios_asistencia_medica_individual();
    });
</script>
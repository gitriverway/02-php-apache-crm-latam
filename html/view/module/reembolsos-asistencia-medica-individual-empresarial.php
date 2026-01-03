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
                    <h1>Reembolsos Asistencia Medica Individual Pymes
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Reembolsos Asistencia Medica Individual Pymes</li>
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
                <!-- <h3 class="card-title">BIENVENIDO AL CONTENIDO DE REEMBOLSOS - ASISTENCIA MEDICA INDIVIDUAL</h3> -->
                <div class="card-tools pull-right">
                    <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;Nuevo
                                Registro</i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla-listar-reembolsos-asistencia-medica-individual"
                    class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">N° Reembolso</th>
                            <th style="text-align:center; width:10px">Fecha Atenci&oacute;n</th>
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
                            <th style="text-align:center; width:10px">Valor Presentado Real</th>
                            <th style="text-align:center; width:10px">Valor Deducible Cobrado</th>
                            <th style="text-align:center; width:10px">Valor No Cubierto</th>
                            <th style="text-align:center; width:10px">Valor Copago</th>
                            <th style="text-align:center; width:10px">Valor Reembolsado</th>
                            <th style="text-align:center; width:10px">Saldo Deducible</th>
                            <th style="text-align:center; width:10px">Fecha Liquidaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Liquidaci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idReembolso">
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
MODAL VALIDAR MODIFICAR REEMBOLSO
======================================-->
<div id="modalModificarReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalValidarDocumentosReembolso">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">VALIDAR DOCUMENTOS REEMBOLSO - <span id="validarNombrePaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row validarDatosReembolso">
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_solicitud" class="control-label">SOLICITUD DE REEMBOLSO
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
                                value="SOLICITUD DE REEMBOLSO">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_factura_medica" class="control-label">FACTURAS
                                MEDICAS
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_factura_medica_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_factura_medica_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_2"
                                    id="radio_factura_medica_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar2"
                                value="FACTURAS MÉDICAS">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_factura_medicina" class="control-label">FACTURAS DE MEDICINAS
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_factura_medicina_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_factura_medicina_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_3"
                                    id="radio_factura_medicina_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar3"
                                value="FACTURAS DE MEDICINAS">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_receta_medica" class="control-label">RECETAS MEDICAS
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_4"
                                    id="radio_receta_medica_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_4"
                                    id="radio_receta_medica_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_4"
                                    id="radio_receta_medica_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar4"
                                value="RECETAS MÉDICAS">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_factura_laboratorio" class="control-label">FACTURAS DE LABORATORIO
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_5"
                                    id="radio_factura_laboratorio_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_5"
                                    id="radio_factura_laboratorio_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_5"
                                    id="radio_factura_laboratorio_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar5"
                                value="FACTURAS DE LABORATORIO">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_pedido_examenes" class="control-label">PEDIDOS DE EXAMENES<font
                                    color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_6"
                                    id="radio_pedido_examenes_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_6"
                                    id="radio_pedido_examenes_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_6"
                                    id="radio_pedido_examenes_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar6"
                                value="PEDIDOS DE EXÁMENES">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_resultado_examenes" class="control-label">RESULTADOS DE EXAMENES<font
                                    color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_7"
                                    id="radio_resultado_examenes_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_7"
                                    id="radio_resultado_examenes_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_7"
                                    id="radio_resultado_examenes_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar7"
                                value="RESULTADOS DE EXÁMENES">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_historia_clinica" class="control-label">HISTORIA CLÍNICA<font color="red">
                                    *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_8"
                                    id="radio_historia_clinica_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_8"
                                    id="radio_historia_clinica_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_8"
                                    id="radio_historia_clinica_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar8"
                                value="HISTORIA CLÍNICA">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_protocolo_operatorio" class="control-label">PROTOCOLO OPERATORIO<font
                                    color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_9"
                                    id="radio_protocolo_operatorio_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_9"
                                    id="radio_protocolo_operatorio_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_9"
                                    id="radio_protocolo_operatorio_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar9"
                                value="PROTOCOLO OPERATORIO">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_hoja_emergencia_008" class="control-label">HOJA EMERGENCIA 008<font
                                    color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_10"
                                    id="radio_hoja_emergencia_008_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_10"
                                    id="radio_hoja_emergencia_008_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_10"
                                    id="radio_hoja_emergencia_008_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar10"
                                value="HOJA EMERGENCIA 008">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_factura_detallada" class="control-label">FACTURAS DEL HOSPITAL DETALLADAS
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_11"
                                    id="radio_factura_detallada_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_11"
                                    id="radio_factura_detallada_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_11"
                                    id="radio_factura_detallada_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar11"
                                value="FACTURAS DEL HOSPITAL DETALLADAS">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_estado_cuenta_hospital" class="control-label">ESTADO DE CUENTA HOSPITAL
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_12"
                                    id="radio_estado_cuenta_hospital_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_12"
                                    id="radio_estado_cuenta_hospital_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_12"
                                    id="radio_estado_cuenta_hospital_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar12"
                                value="ESTADO DE CUENTA HOSPITAL">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_pedido_fisioterapia" class="control-label">PEDIDOS FISIOTERAPIA
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_13"
                                    id="radio_pedido_fisioterapia_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_13"
                                    id="radio_pedido_fisioterapia_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_13"
                                    id="radio_pedido_fisioterapia_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar13"
                                value="PEDIDOS FISIOTERAPIA">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_factura_fisioterapia" class="control-label">FACTURAS FISIOTERAPIA
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_14"
                                    id="radio_factura_fisioterapia_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_14"
                                    id="radio_factura_fisioterapia_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_14"
                                    id="radio_factura_fisioterapia_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar14"
                                value="FACTURAS FISIOTERAPIA">
                        </div>
                        <div class="form-group col-12 col-lg-4 col-md-6">
                            <label for="radio_bitacora_asistencia_fisioterapia" class="control-label">BITACORA
                                ASISTENCIA FISIOTERAPIA
                                <font color="red"> *</font>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_15"
                                    id="radio_bitacora_asistencia_fisioterapia_1" value="SI">
                                <label class="form-check-label">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_15"
                                    id="radio_bitacora_asistencia_fisioterapia_2" value="NO" checked>
                                <label class="form-check-label">NO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_validacion" type="radio" name="radio_15"
                                    id="radio_bitacora_asistencia_fisioterapia_3" value="N/A">
                                <label class="form-check-label">N/A</label>
                            </div>
                            <input type="hidden" class="etiquetaRadioValidar" id="etiquetaRadioValidar15"
                                value="BITACORA ASISTENCIA FISIOTERAPIA">
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
                            <label for=" txt_observaciones_reembolso" class="control-label" style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_reembolso validarNumerosLetrasDecimal"
                                id="txt_observaciones_reembolso" name="txt_observaciones_reembolso" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                        </div>
                        <input type="hidden" id="listaValidarDatosReembolso">
                        <input type="hidden" id="listaObservacionesDatosReembolso">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Validar_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR OBSERVACION ADICIONAL REEMBOLSO
======================================-->
<div id="modalAgregarObservacionAdicionalReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR OBSERVACIONES AL REEMBOLSO - <span
                            id="agregarObservacionAdicionalPaciente"></span>
                    </h5>
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
                            <label for=" txt_observaciones_adicionales_seguimiento_reembolso" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea
                                class="form-control observaciones_adicionales_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_adicionales_seguimiento_reembolso"
                                name="txt_observaciones_adicionales_seguimiento_reembolso" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosReembolso">
                            <input type="hidden" id="listaObservacionesAdicionalesSeguimientosReembolsoAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_adicionales_Seguimiento_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--=====================================
MODAL AGREGAR SEGUIMIENTO REEMBOLSO
======================================-->
<div id="modalAgregarSeguimientoReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoReembolso">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR SEGUIMIENTO AL REEMBOLSO - <span
                            id="agregarSeguimientoReembolsoPaciente"></span></h5>
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
                    <div class="row seguimientoDatosReembolso">

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
                            <label for=" txt_observaciones_seguimiento_reembolso" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_reembolso"
                                name="txt_observaciones_seguimiento_reembolso" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosReembolso">
                            <input type="hidden" id="listaObservacionesSeguimientosReembolsoAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso_documento_pedido_aseguradora" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_reembolso_documento_pedido_aseguradora"
                                name="txt_documento_reembolso_documento_pedido_aseguradora" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Seguimiento_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modalAgregarSeguimientoReembolso_1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSeguimientoReembolso_1">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR SEGUIMIENTO AL REEMBOLSO - <span
                            id="agregarSeguimientoReembolsoPaciente1"></span></h5>
                </div>
                <div class="modal-body">
                    <!--=====================================
                                BOTÓN PARA AGREGAR DEPENDIENTE
                                ======================================-->
                    <div class="form-group row">
                        <button type="button" class="btn btn-default btnAgregarDocumentoRequeridoAseguradora_1">Agregar
                            Documento</button>
                        <input type="hidden" id="listaDocumentosSolicitadosAseguradora_1"
                            name="listaDocumentosSolicitadosAseguradora_1">
                        <input type="hidden" id="listaDocumentosSolicitadosAseguradoraAnterior_1"
                            name="listaDocumentosSolicitadosAseguradoraAnterior_1">
                    </div>
                    <div class="row seguimientoDatosReembolso_1">

                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="enviarEmail_1" name="enviarEmail_1" type="checkbox"
                                    checked>
                                <label class="form-check-label">Enviar Email</label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_fecha_seguimiento_1" class="control-label" style="text-align: right;">FECHA
                                SEGUIMIENTO CLIENTE
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_seguimiento" id="txt_fecha_seguimiento_1"
                                name="txt_fecha_seguimiento_1">
                        </div>
                        <div class="form-group col-12">
                            <div class="form-check">
                                <input class="form-check-input" id="estadoCaducado_1" name="estadoCaducado_1"
                                    type="checkbox">
                                <label class="form-check-label">Estado Caducado</label>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_seguimiento_reembolso_1" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_seguimiento_1 validarNumerosLetrasDecimal"
                                id="txt_observaciones_seguimiento_reembolso_1"
                                name="txt_observaciones_seguimiento_reembolso_1" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesSeguimientosReembolso_1">
                            <input type="hidden" id="listaObservacionesSeguimientosReembolsoAnterior_1">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso_documento_pedido_aseguradora_1" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_reembolso_documento_pedido_aseguradora_1"
                                name="txt_documento_reembolso_documento_pedido_aseguradora_1" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Modificar_Seguimiento_Reembolso_1()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO REEMBOLSO
======================================-->
<div id="modalAgregarDocumentoSeguimientoReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoReembolso">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO ADICIONALES AL REEMBOLSO - <span
                            id="agregarDocumentoSeguimientoReembolsoPaciente"></span></h5>
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
                            <label for=" txt_observaciones_documento_seguimiento_reembolso" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_reembolso"
                                name="txt_observaciones_documento_seguimiento_reembolso" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosReembolso">
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosReembolsoAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso_documento_seguimiento" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_reembolso_documento_seguimiento"
                                name="txt_documento_reembolso_documento_seguimiento" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR DOCUMENTOS SEGUIMIENTO REEMBOLSO
======================================-->
<div id="modalAgregarDocumentoSeguimientoReembolso_1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoSeguimientoReembolso_1">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO ADICIONALES AL REEMBOLSO - <span
                            id="agregarDocumentoSeguimientoPaciente1"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_fecha_documento_seguimiento_aseguradora_1" class="control-label"
                                style="text-align: right;">FECHA
                                SEGUIMIENTO ASEGURADORA
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control txt_fecha_documento_seguimiento_aseguradora_1"
                                id="txt_fecha_documento_seguimiento_aseguradora_1"
                                name="txt_fecha_documento_seguimiento_aseguradora_1">
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_documento_seguimiento_reembolso_1" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_documento_seguimiento_reembolso_1"
                                name="txt_observaciones_documento_seguimiento_reembolso_1" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosReembolso_1">
                            <input type="hidden" id="listaObservacionesDocumentoSeguimientosReembolsoAnterior_1">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso_documento_seguimiento_1" class="control-label"
                                style="text-align: right;">DOCUMENTOS ADICIONALES
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_reembolso_documento_seguimiento_1"
                                name="txt_documento_reembolso_documento_seguimiento_1" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Seguimiento_Reembolso_1()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR LIQUIDACION REEMBOLSO
======================================-->
<div id="modalAgregarDocumentoLiquidacionReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalDocumentoLiquidacionReembolso">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR DOCUMENTO LIQUIDACION AL REEMBOLSO - <span
                            id="agregarDocumentoLiquidacionReembolsoPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="txt_idBayer">
                        <input type="hidden" id="listaDependientes">
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_colaborador_reembolso" class="control-label"
                                style="text-align: right;">COLABORADOR DEL REEMBOLSO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control validarNumerosLetrasDecimal txt_colaborador_reembolso"
                                    id="txt_colaborador_reembolso" name="txt_colaborador_reembolso" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_paciente_reembolso" class="control-label"
                                style="text-align: right;">PACIENTE DEL REEMBOLSO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control validarNumerosLetrasDecimal txt_paciente_reembolso"
                                    id="txt_paciente_reembolso" name="txt_paciente_reembolso" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_deducible_contrato_dependiente" class="control-label"
                                style="text-align: right;">DEDUCIBLE CONTRATADO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal valor_liquidacion"
                                    id="txt_deducible_contrato_dependiente" name="txt_deducible_contrato_dependiente"
                                    value="0" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_saldo_deducible" class="control-label" style="text-align: right;">SALDO
                                DEDUCIBLE
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal valor_liquidacion"
                                    id="txt_saldo_deducible" name="txt_saldo_deducible" value="0" disabled>
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_valor_presentado_liquidacion" class="control-label"
                                style="text-align: right;">VALOR PRESENTADO REAL
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal"
                                    id="txt_valor_presentado_liquidacion" name="txt_valor_presentado_liquidacion"
                                    value="0">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_valor_no_cubierto" class="control-label" style="text-align: right;">VALOR NO
                                CUBIERTO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal" id="txt_valor_no_cubierto"
                                    name="txt_valor_no_cubierto" value="0">
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_valor_deducible" class="control-label" style="text-align: right;">DEDUCIBLE
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

                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_valor_copago" class="control-label" style="text-align: right;">VALOR COPAGO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal" id="txt_valor_copago"
                                    name="txt_valor_copago" value="0">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_valor_reembolsado" class="control-label" style="text-align: right;">VALOR
                                REEMBOLSADO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control validarNumerosDecimal" id="txt_valor_reembolsado"
                                    name="txt_valor_reembolsado" value="0" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_liquidacion_reembolso" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES<font color="red"> *</font>
                            </label>
                            <textarea class="form-control observaciones_seguimiento validarNumerosLetrasDecimal"
                                id="txt_observaciones_liquidacion_reembolso"
                                name="txt_observaciones_liquidacion_reembolso" cols="20" rows="4"
                                placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesLiquidacionReembolso">
                            <input type="hidden" id="listaObservacionesLiquidacionReembolsoAnterior">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso_documento_liquidacion" class="control-label"
                                style="text-align: right;">DOCUMENTOS LIQUIDACI&Oacute;N
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control subirDocumento"
                                id="txt_documento_reembolso_documento_liquidacion"
                                name="txt_documento_reembolso_documento_liquidacion" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Documento_Liquidacion_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--=====================================
MODAL AGREGAR OBSERVACION ANULACION REEMBOLSO
======================================-->
<div id="modalAgregarAnulacionReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">AGREGAR ANULACIÓN AL REEMBOLSO - <span
                            id="agregarAnulacionReembolsoPaciente"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for=" txt_observaciones_anulacion_reembolso" class="control-label"
                                style="text-align: right;">
                                OBSERVACIONES
                            </label>
                            <textarea class="form-control observaciones_anulacion validarNumerosLetrasDecimal"
                                id="txt_observaciones_anulacion_reembolso" name="txt_observaciones_anulacion_reembolso"
                                cols="20" rows="4" placeholder="Ingresar Comentarios"></textarea>
                            <input type="hidden" id="listaObservacionesAnulacionReembolso">
                            <input type="hidden" id="listaObservacionesAnulacionReembolsoAnterior">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary"
                        onclick="Modificar_Observaciones_Anulacion_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL INGRESAR NUEVO REEMBOLSO
======================================-->
<div id="modalAgregarReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalNuevoReembolso">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">NUEVO REEMBOLSO</h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosReembolso">
                        <div class="form-group col-12 col-lg-4">
                            <label for="txt_fecha_atencion" class="control-label" style="text-align: right;">FECHA
                                ATENCIÓN
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_atencion" id="txt_fecha_atencion"
                                name="txt_fecha_atencion">
                        </div>
                        <div class="form-group col-12 col-lg-4">
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
                        <div class="form-group col-12 col-lg-4">
                            <label for="cbm_nombre_colaborador" class="control-label" style="text-align: right;">NOMBRE
                                COLABORADOR
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_nombre_colaborador js-example-basic-single" name="state"
                                id="cbm_nombre_colaborador" style="width:100%;">
                                <option value="">SIN REGISTROS</option>
                            </select>
                            <input type="hidden" id="lista_colaboradores" name="lista_colaboradores">
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="cbm_nombre_paciente" class="control-label" style="text-align: right;">NOMBRE
                                PACIENTE
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_nombre_paciente js-example-basic-single" name="state"
                                id="cbm_nombre_paciente" style="width:100%;">
                                <option value="">SIN REGISTROS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_presentado" class="control-label" style="text-align: right;">VALOR
                                REEMBOLSO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control valor_presentado validarNumerosDecimal"
                                    id="txt_valor_presentado" name="txt_valor_presentado" placeholder="0.00">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_diagnostico" class="control-label" style="text-align: right;">DIAGNÓSTICO
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control diagnostico_reembolso validarNumerosLetrasDecimal"
                                id="txt_diagnostico" name="txt_diagnostico" cols="20" rows="4"
                                placeholder="Ingresar Diagnostico"></textarea>
                        </div>

                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso" class="control-label"
                                style="text-align: right;">DOCUMENTOS
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_documento_reembolso"
                                name="txt_documento_reembolso" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 50MB</p>
                        </div>
                        <input type="hidden" id="listaDatosReembolso">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Registrar_Reembolso()"><i
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
<script src="js/reembolsos-asistencia-medica-individual-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_reembolsos_asistencia_medica_individual();
    });
</script>
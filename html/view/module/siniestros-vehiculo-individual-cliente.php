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
                    <h1>Reportar Siniestros Vehiculo
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Siniestros Vehiculo Individual</li>
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
                <table id="tabla-listar-siniestros-vehiculo-individual"
                    class="table table-bordered table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">N° Siniestro</th>
                            <th style="text-align:center; width:10px">Fecha Siniestro</th>
                            <th style="text-align:center; width:10px">Fecha Creaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Vehiculo</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Documento Inicial</th>
                            <th style="text-align:center; width:10px">Ajuste, Aceptación y Autorización</th>
                            <th style="text-align:center; width:10px">Ajuste, Aceptación y Autorización - Daños Terceros
                            </th>
                            <th style="text-align:center; width:10px">Documento Requeridos</th>
                            <th style="text-align:center; width:10px">Envio Aseguradora</th>
                            <th style="text-align:center; width:10px">Observaciones</th>
                            <th style="text-align:center; width:10px">Fecha Modificaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Valor Siniestro</th>
                            <th style="text-align:center; width:10px">Valor Deducible</th>
                            <th style="text-align:center; width:10px">Valor RASA</th>
                            <th style="text-align:center; width:10px">Valor Cubierto</th>
                            <th style="text-align:center; width:10px">Valor Indemnizar</th>
                            <th style="text-align:center; width:10px">Valor Paga Cliente</th>
                            <th style="text-align:center; width:10px">Liquidaci&oacute;n</th>
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
MODAL INGRESAR NUEVO SINIESTRO
======================================-->
<div id="modalAgregarSiniestro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalNuevoSiniestro">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">NUEVO SINIESTRO</h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosSiniestro">
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_fecha_siniestro" class="control-label" style="text-align: right;">FECHA
                                SINIESTRO
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_siniestro" id="txt_fecha_siniestro"
                                name="txt_fecha_siniestro">
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
                            <label for="cbm_vehiculo" class="control-label" style="text-align: right;">VEHICULO
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_vehiculo js-example-basic-single" name="state"
                                id="cbm_vehiculo" style="width:100%;">
                                <option value="">SIN REGISTROS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-8">
                            <label for="txt_lugar_siniestro" class="control-label" style="text-align: right;">LUGAR DEL
                                SINIESTRO<font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control lugar_siniestro validarNumerosLetrasDecimal"
                                    id="txt_lugar_siniestro" name="txt_lugar_siniestro"
                                    placeholder="LUGAR DEL SINIESTRO" style="text-transform: uppercase">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="radio_danos_terceros" class="control-label">DAÑOS A TERCEROS
                                <font color="red"> *</font>
                            </label>
                            <div>
                                <div class="form-check-inline">
                                    <input class="form-check-input radio_danos_tercero" type="radio"
                                        name="radio_danos_tercero" id="radio_danos_terceros_1" value="SI">
                                    <label class="form-check-label">SI</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input radio_danos_tercero" type="radio"
                                        name="radio_danos_tercero" id="radio_danos_terceros_2" value="NO" checked>
                                    <label class="form-check-label">NO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="datosTerceros">
                            <div class="card card-primary" id="cardDatosTerceros">
                                <div class="card-header">
                                    <h3 class="card-title">DATOS TERCEROS AFECTADOS</h3>
                                </div>
                                <!-- Default box -->
                                <div class="card-body">
                                    <div class="row nuevoDatosTerceroSiniestro">
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="txt_nombre_afectado_siniestro" class="control-label"
                                                style="text-align: right;">NOMBRE AFECTADO
                                                <font color="red"> *</font>
                                            </label>
                                            <input type="text"
                                                class="form-control validarNumerosLetrasDecimal nombre_afectado_siniestro"
                                                id="txt_nombre_afectado_siniestro" name="txt_nombre_afectado_siniestro"
                                                placeholder="LUGAR DEL SINIESTRO" style="text-transform: uppercase">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="txt_telefono_afectado_siniestro" class="control-label"
                                                style="text-align: right;">TELEFONO CONTACTO
                                                <font color="red"> *</font>
                                            </label>
                                            <input type="text"
                                                class="form-control validarNumerosLetrasDecimal telefono_afectado_siniestro"
                                                id="txt_telefono_afectado_siniestro"
                                                name="txt_telefono_afectado_siniestro"
                                                placeholder="LUGAR DEL SINIESTRO">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="listaDatosTerceroSiniestro">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_detalle_siniestro" class="control-label" style="text-align: right;">DETALLE
                                SINIESTRO
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control detalle_siniestro validarNumerosLetrasDecimal"
                                id="txt_detalle_siniestro" name="txt_detalle_siniestro" cols="20" rows="4"
                                placeholder="Ingresar Diagnostico" style="text-transform: uppercase"></textarea>
                        </div>

                        <div class="form-group col-12">
                            <label for="txt_documento_siniestro" class="control-label"
                                style="text-align: right;">DOCUMENTOS
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_documento_siniestro"
                                name="txt_documento_siniestro" accept=".pdf">
                            <p class="help-block">Peso máximo del documento 25MB</p>
                        </div>
                        <input type="hidden" id="listaDatosSiniestro">
                        <!-- <div class="col-12 d-none" id="formularioZurich">
                            <a class="text-lg" target="_blank"
                                href="https://www.zurichseguros.com.ec/es-ec/servicios-clientes/formulariosiniestros">Formulario
                                zurich</a>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Registrar_Siniestro()"><i
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
                        <table id="table_listar_contratos_cliente" class="table table-bordered table-striped nowrap"
                            style="width:100%">
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
<script src="js/siniestros-vehiculo-individual-cliente.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_siniestros_cliente_vehiculo_individual();
    });
</script>
<?php

switch ($_SESSION["S_ROL"]) {
    case 'GERENTE':
        # code...
        break;

    case 'SERVICIO CLIENTE':
        # code...
        break;

    default:
        echo '<script>window.location = "inicio";</script>';
        return;
        break;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Editar Emisi&oacute;n Incendio Empresarial
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Emisi&oacute;n Incendio Empresarial</li>
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
                        <h3 class="card-title">Datos Bayer Persona</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- ENTRADA VENDEDOR -->
                                <div class="form-group">
                                    <label for="txt_vendedor" class="control-label"
                                        style="text-align: right;">VENDEDOR</label>
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
                                    <label for="cbm_origen" class=" control-label" style="text-align: right;">ORIGEN
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_origen" name="state" id="cbm_origen">
                                        <option value="">Seleccione...</option>
                                        <option value="MQP">MQP</option>
                                        <option value="AMIGO">AMIGO</option>
                                        <option value="CHAT">CHAT</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="txt_categoria" class="control-label" style="text-align: right;">RAMOS
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
                                        style="text-align: right;">ASEGURADORA
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_proveedor" name="state" id="cbm_proveedor">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PLAN DE SEGURO-->
                                <div class="form-group">
                                    <label for="cbm_proveedor" class=" control-label" style="text-align: right;">PLAN
                                        SEGURO
                                        <font color="red"> *</font>
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
                                        style="text-align: right;">VALOR
                                        ASEGURADO
                                        <font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_valor_asegurado" placeholder="INGRESOS VALOR ASEGURADO" min="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA NETA -->
                                <div class="form-group">
                                    <label for="txt_prima_neta" class="control-label" style="text-align: right;">PRIMA
                                        NETA
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_neta" placeholder="INGRESOS PRIMA NETA" min="0" maxlength="30"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA COMISIONABLE -->
                                <div class="form-group">
                                    <label for="txt_prima_comisionable" class="control-label"
                                        style="text-align: right;">PRIMA COMISIONABLE
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_comisionable" placeholder="INGRESOS PRIMA COMISIONABLE"
                                            min="0" maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA TOTAL -->
                                <div class="form-group">
                                    <label for="txt_prima_total" class="control-label" style="text-align: right;">PRIMA
                                        TOTAL<font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_total" placeholder="INGRESOS PRIMA TOTAL" min="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA SELECCIONAR FORMA DE PAGO -->
                                <div class="form-group">
                                    <label for="cbm_tipo_pago" class="control-label"
                                        style="text-align: right;">FRECUENCIA DE
                                        PAGO<font color="red"> *</font></label>
                                    <select class="form-control cbm_tipo_pago" name="state" id="cbm_tipo_pago"
                                        style="width:100%;">
                                        <option value="">Seleccione...</option>
                                        <option value="MENSUAL">MENSUAL</option>
                                        <option value="TRIMESTRAL">TRIMESTRAL</option>
                                        <option value="SEMESTRAL">SEMESTRAL</option>
                                        <option value="ANUAL">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA SELECCIONAR FORMA DE PAGO -->
                                <div class="form-group">
                                    <label for="cbm_forma_pago" class="control-label" style="text-align: right;">FORMA
                                        DE
                                        PAGO<font color="red"> *</font></label>
                                    <select class="form-control cbm_forma_pago" name="state" id="cbm_forma_pago"
                                        style="width:100%;">
                                        <option value="">Seleccione...</option>
                                        <option value="DEBITO BANCARIO">DEBITO BANCARIO</option>
                                        <option value="TRANSFERENCIA BANCARIO">TRANSFERENCIA BANCARIO</option>
                                        <option value="TARJETA DE CREDITO">TARJETA DE CREDITO</option>
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
                        <h3 class="card-title">Informaci&oacute;n Personal</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA EL DOCUMENTO -->
                                <div class="form-group">
                                    <label for="txt_documento" class="control-label" style="text-align: right;">CEDULA
                                        <font color="red"> *</font>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control validarNumerosLetras" id="txt_documento"
                                            placeholder="INGRESAR CEDULA/RUC" autocomplete="off"
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
                                    <label for="txt_nombre" class="control-label" style="text-align: right;">NOMBRE
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_nombre"
                                        placeholder="INGRESE NOMBRE" maxlength="50" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" style="text-align: right;">GENERO
                                        <font color="red"> *</font>
                                    </label>
                                    <select id="genero" name="genero" class="form-control genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
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
                                        placeholder="INGRESE EMAIL" maxlength="50" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EMAIl -->
                                <div class="form-group">
                                    <label for="txt_email_opcional" class="control-label"
                                        style="text-align: right;">EMAIL (OPCIONAL)
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetrasDecimal"
                                        id="txt_email_opcional" placeholder="INGRESE EMAIL" maxlength="50"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA TELEFONO -->
                                <div class="form-group">
                                    <label for="txt_telefono" class="control-label" style="text-align: right;">TELEFONO
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_telefono"
                                        placeholder="INGRESE TELEFONO" maxlength="50" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA TELEFONO -->
                                <div class="form-group">
                                    <label for="txt_telefono_opcional" class="control-label"
                                        style="text-align: right;">TELEFONO(OPCIONAL)
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras"
                                        id="txt_telefono_opcional" placeholder="INGRESE TELEFONO" maxlength="50"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                                <div class="form-group">
                                    <label for="cbm_provincia" class="control-label"
                                        style="text-align: right;">PROVINCIA<font color="red"> *</font></label>
                                    <select class="form-control cbm_provincia" name="state" id="cbm_provincia">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR CIUDAD -->
                                <div class="form-group">
                                    <label for="txt_ciudad" class="control-label" style="text-align: right;">CIUDAD
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_ciudad"
                                        placeholder="INGRESE CIUDAD" maxlength="100" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA DIRECCION -->
                                <div class="form-group">
                                    <label for="txt_direccion" class="control-label"
                                        style="text-align: right;">DIRECCION
                                        DOMICILIO<font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_direccion"
                                        placeholder="INGRESE DIRECCION" autocomplete="off"
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
                                        placeholder="INGRESE OCUPACI&Oacute;N" maxlength="50" autocomplete="off"
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
                                        <option value="">Seleccione...</option>
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
                        <h3 class="card-title">Informaci&oacute;n Documentos</h3>
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
                                                <p class="help-block">Peso máximo del documento 50MB</p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_2" class="control-label"
                                                    style="text-align: right;">CONTRATO<font color="red"> *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_2"
                                                    name="txt_documento_2" class="subirDocumento" accept=".pdf">
                                                <p class="help-block">Peso máximo del documento 50MB</p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_3" class="control-label"
                                                    style="text-align: right;">FACTURA<font color="red"> *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_3"
                                                    name="txt_documento_3" class="subirDocumento" accept=".pdf">
                                                <p class="help-block">Peso máximo del documento 50MB</p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_4" class="control-label"
                                                    style="text-align: right;">CARTA NOMBRAMIENTO<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_4"
                                                    name="txt_documento_4" class="subirDocumento" accept=".pdf">
                                                <p class="help-block">Peso máximo del documento 50MB</p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_5" class="control-label"
                                                    style="text-align: right;">FORMULARIO VINCULACIÓN<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_5"
                                                    name="txt_documento_5" class="subirDocumento" accept=".pdf">
                                                <p class="help-block">Peso máximo del documento 50MB</p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_6" class="control-label"
                                                    style="text-align: right;">ENDOSOS<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_6"
                                                    name="txt_documento_6" class="subirDocumento" accept=".pdf">
                                                <p class="help-block">Peso máximo del documento 50MB</p>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <label for="txt_documento_7" class="control-label"
                                                    style="text-align: right;">REPORTE DE SINIESTRO<font color="red">
                                                        *</font>
                                                </label>
                                                <input type="file" class="form-control" id="txt_documento_7"
                                                    name="txt_documento_7" class="subirDocumento" accept=".pdf">
                                                <p class="help-block">Peso máximo del documento 50MB</p>
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
                        <h3 class="card-title">Informaci&oacute;n Seguimiento</h3>
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
                                                <option value="">Seleccione...</option>
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
                                        data-dismiss="modal">CANCELAR</button></a>
                                <button type="submit" class="btn btn-primary float-right"
                                    onclick="Modificar_Cliente()"><i
                                        class="fa fa-save"><b>&nbsp;GUARDAR</b></i></button>
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
                    <h5 class="modal-title">LISTA CLIENTES</h5>
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
                    <h5 class="modal-title">AGREGAR OBSERVACI&Oacute;N</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                        <label for="txt_observacion" class="control-label" style="text-align: right;">OBSERVACI&Oacute;N
                            <font color="red"> *</font>
                        </label>
                        <textarea class="form-control validarNumerosLetrasDecimal" id="txt_observacion"
                            name="txt_observacion" cols="20" rows="5"
                            placeholder="Ingresar Observaci&oacute;n"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary" onclick="agregarNuevaObservacion()">AGREGAR</button>
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
                    <h5 class="modal-title">Lista de Documentos</h5>
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

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/clientes-incendio-empresarial.js?rev=<?php echo time(); ?>"></script>
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
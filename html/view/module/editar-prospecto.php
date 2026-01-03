<?php

if ($_SESSION["S_ROL"] == "CLIENTE") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';

    return;
}

require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function($key) {
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
                    <h1><?php echo $t('messages.edit_prospect'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.edit_prospect'); ?></li>
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
                        <h3 class="card-title"><?php echo $t('messages.bayer_person_data'); ?></h3>
                    </div>
                    <!-- Default box -->
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
                                <input type="hidden" id="txt_idProspecto" value="<?php echo $_GET["idProspecto"]; ?>">
                                <!-- ENTRADA PARA EL ORIGEN CLIENTE -->
                                <div class="form-group">
                                    <label for="cbm_origen" class=" control-label" style="text-align: right;">ORIGEN
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_origen" name="state" id="cbm_origen"
                                        <?php echo $retVal = ($_SESSION["S_ROL"] == "VENDEDOR") ? "disabled" : ""; ?>>
                                        <option value="">Seleccione...</option>
                                        <option value="MQP">MQP</option>
                                        <option value="AMIGO">AMIGO</option>
                                        <option value="CHAT">CHAT</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EL NUEVO RAMO -->
                                <div class="form-group">
                                    <label for="txt_origen_web" class="control-label" style="text-align: right;">ORIGEN
                                        WEB
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_origen_web"
                                        autocomplete="off" style="text-transform: uppercase" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA LOS RAMOS -->
                                <div class="form-group">
                                    <label for="cbm_categoria" class=" control-label" style="text-align: right;">RAMOS
                                        <font color="red"> *</font>
                                    </label>
                                    <select class="form-control cbm_categoria" name="state" id="cbm_categoria">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EL NUEVO RAMO -->
                                <div class="form-group">
                                    <label for="txt_nuevo_categoria" class="control-label"
                                        style="text-align: right;">NUEVO RAMO
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
                                        style="text-align: right;">ASEGURADORA
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
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_valor_asegurado" placeholder="INGRESOS VALOR ASEGURADO" value="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA NETA ANUAL -->
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
                                            id="txt_prima_neta" placeholder="INGRESOS PRIMA NETA" value="0"
                                            maxlength="30" autocomplete="off">
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
                                            value="0" maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA PRIMA TOTAL -->
                                <div class="form-group">
                                    <label for="txt_prima_total" class="control-label" style="text-align: right;">PRIMA
                                        TOTAL
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text"
                                            class="form-control validarNumerosDecimal input-lg valores_emision"
                                            id="txt_prima_total" placeholder="INGRESOS PRIMA TOTAL" value="0"
                                            maxlength="30" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR FORMA DE PAGO -->
                                <div class="form-group">
                                    <label for="cbm_tipo_pago" class="control-label"
                                        style="text-align: right;">FRECUENCIA DE
                                        PAGO</label>
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
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA SELECCIONAR FORMA DE PAGO -->
                                <div class="form-group">
                                    <label for="cbm_forma_pago" class="control-label" style="text-align: right;">FORMA
                                        DE
                                        PAGO</label>
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
            </div>
            <div class="col-md-6">
                <div class="card card-primary" id="cardPersonal">
                    <div class="card-header">
                        <h3 class="card-title">Informaci&oacute;n Personal</h3>
                    </div>
                    <!-- Default box -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EL DOCUMENTO -->
                                <div class="form-group">
                                    <label for="txt_documento" class="control-label" style="text-align: right;">CEDULA
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control validarNumerosLetras" id="txt_documento"
                                            placeholder="<?php echo $t('messages.enter_id_card'); ?>" autocomplete="off"
                                            style="text-transform: uppercase">

                                        <input type="hidden" id="txt_idCliente">
                                        <!-- <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary btnListarClientes"><i
                                                    class="fas fa-search"></i></button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA NOMBRE -->
                                <div class="form-group">
                                    <label for="txt_nombre" class="control-label" style="text-align: right;">NOMBRE
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_nombre"
                                        placeholder="INGRESE NOMBRE" maxlength="50" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA GENERO-->
                                <div class="form-group">
                                    <label class="control-label" style="text-align: right;">GENERO
                                    </label>
                                    <select id="genero" name="genero" class="form-control genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA ESTADO CIVIL -->
                                <div class="form-group">
                                    <label for="estado_civil" class="control-label" style="text-align: right;">ESTADO
                                        CIVIL<font color="red"> *
                                        </font>
                                    </label>
                                    <select id="estado_civil" name="estado_civil" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <option value="SOLTERO">SOLTERO/A</option>
                                        <option value="CASADO">CASADO/A</option>
                                        <option value="DIVORCIADO">DIVORCIADO/A</option>
                                        <option value="VIUDO">VIUDO/A</option>
                                        <option value="UNIÓN LIBRE">UNIÓN LIBRE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA FECHA DE NACIMIENTO -->
                                <div class="form-group">
                                    <label for="txt_fecha_nacimiento" class="control-label"
                                        style="text-align: right;">F.NACIMIENTO
                                    </label>
                                    <input type="date" class="form-control" id="txt_fecha_nacimiento"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EDAD NACIMIENTO -->
                                <div class="form-group">
                                    <label for="txt_edad_nacimiento" class="control-label"
                                        style="text-align: right;">EDAD
                                        <font color="red"> *</font>
                                    </label>
                                    <input type="number" min="0" class="form-control" id="txt_edad_nacimiento"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA EMAIl -->
                                <div class="form-group">
                                    <label for="txt_email" class="control-label" style="text-align: right;">EMAIL
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetrasDecimal" id="txt_email"
                                        placeholder="<?php echo $t('messages.enter_email'); ?>" maxlength="50" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA TELEFONO -->
                                <div class="form-group">
                                    <label for="txt_telefono" class="control-label" style="text-align: right;">TELEFONO
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_telefono"
                                        placeholder="<?php echo $t('messages.enter_phone'); ?>" maxlength="50" autocomplete="off">
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
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_ciudad"
                                        placeholder="<?php echo $t('messages.enter_city'); ?>" maxlength="100" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- ENTRADA PARA DIRECCION -->
                                <div class="form-group">
                                    <label for="txt_direccion" class="control-label"
                                        style="text-align: right;">DIRECCION
                                        DOMICILIO
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_direccion"
                                        placeholder="<?php echo $t('messages.enter_address'); ?>" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA OCUPACION -->
                                <div class="form-group">
                                    <label for="txt_ocupacion" class="control-label"
                                        style="text-align: right;">PROFESI&Oacute;N
                                    </label>
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_ocupacion"
                                        placeholder="<?php echo $t('messages.enter_occupation'); ?>" maxlength="50" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <!-- ENTRADA PARA INGRESOS -->
                                <div class="form-group">
                                    <label for="cbm_ingreso_mensual" class="control-label"
                                        style="text-align: right;">INGRESOS
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
            </div>
            <div class="col-sm-12">
                <div class="card card-primary" id="cardDependientes">
                    <div class="card-header">
                        <h3 class="card-title">Informaci&oacute;n Dependientes</h3>
                    </div>
                    <!-- Default box -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" id="txt_idDependiente">
                                        <!--=====================================
                                            BOTÓN PARA AGREGAR DEPENDIENTE
                                            ======================================-->
                                        <div class="form-group row">
                                            <button type="button" class="btn btn-default btnAgregarDependiente">Agregar
                                                Dependencia</button>
                                            <input type="hidden" id="listaFamiliares" name="listaFamiliares">
                                        </div>
                                        <!--=====================================
                                ENTRADA PARA AGREGAR DEPENDIENTE
                                ======================================-->
                                        <div class="form-group row nuevoDependiente">

                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <!--=====================================
                                BOTÓN PARA AGREGAR VEHICULO
                                ======================================-->
                                        <div class="form-group row">
                                            <button type="button" class="btn btn-default btnAgregarVehiculo">Agregar
                                                Vehiculo</button>
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
                                BOTÓN PARA AGREGAR HOGAR
                                ======================================-->
                                        <div class="form-group row">
                                            <button type="button" class="btn btn-default btnAgregarHogar">Agregar
                                                Hogar</button>
                                            <input type="hidden" id="listaHogares" name="listaHogares">
                                        </div>
                                        <!--=====================================
                                ENTRADA PARA AGREGAR HOGAR
                                ======================================-->

                                        <div class="form-group row nuevoHogar">

                                        </div>

                                    </div>

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
                                        <!-- ENTRADA PARA FECHA DE SEGUIMENTO -->
                                        <div class="form-group">
                                            <label for="txt_fecha_seguimiento" class="control-label"
                                                style="text-align: right;">SEGUIMIENTO</label>
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
                                                <!-- <option value="NO CONTESTA">NO CONTESTA</option> -->
                                                <option value="NO INTERESADO">NO INTERESADO</option>
                                                <option value="INTERESADO">INTERESADO</option>
                                                <option value="INTERESADO ALTO">INTERESADO ALTO</option>
                                                <option value="INTERESADO MEDIO">INTERESADO MEDIO</option>
                                                <option value="INTERESADO BAJO">INTERESADO BAJO</option>
                                                <option value="CONTRATADO">CONTRATADO</option>
                                                <option value="DUPLICADO">DUPLICADO</option>
                                                <option value="NO RECUPERADO">NO RECUPERADO</option>
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
                                <a href="prospecto-asignado"><button type="button" class="btn btn-default"
                                        data-dismiss="modal">CANCELAR</button></a>
                                <button type="submit" class="btn btn-primary float-right"
                                    onclick="Modificar_Prospecto()"><i
                                        class="fa fa-save"><b>&nbsp;GUARDAR</b></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
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
<script src="js/prospecto.js?rev=<?php echo time(); ?>"></script>

<script>
$(document).ready(function() {
    listar_clientes_para_seleccionar();
    listar_combo_categoria();
    listar_combo_aseguradora();
    listar_combo_provincia();
    listar_empleados_para_seleccionar();
    $("#modalAgregarObservacion").on('shown.bs.modal', function() {
        $("#txt_observacion").focus();
    });
    setTimeout(function() {
        cargar_datos_prospecto();
    }, 2000);
});
</script>
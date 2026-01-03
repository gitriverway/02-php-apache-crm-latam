<?php

if($_SESSION["S_ROL"] == "CLIENTE"){

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
                <?php
                require_once __DIR__ . '/../../model/modelo_idioma.php';
                $t = function($key) {
                    return Modelo_Idioma::t($key);
                };
                ?>
                <div class="col-sm-6">
                    <h1><?php echo $t('messages.list_clients'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.list_clients'); ?></li>
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
                <table id="tabla_cliente" class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Nombre</th>
                            <th style="text-align:center; width:10px">Cedula/Ruc</th>
                            <th style="text-align:center; width:10px">Fecha Nacimiento</th>
                            <th style="text-align:center; width:10px">Genero</th>
                            <th style="text-align:center; width:10px">Email</th>
                            <th style="text-align:center; width:10px">Enviar Acceso</th>
                            <th style="text-align:center; width:10px">Recuperar Contrase&ntilde;a</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idCliente" value="0">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!--=====================================
MODAL ASIGNAR VENDEDOR
======================================-->
<div id="modal_editar_cliente" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">Editar Cliente</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA EL DOCUMENTO -->
                            <div class="form-group">
                                <label for="txt_documento" class="control-label" style="text-align: right;">CEDULA
                                    <font color="red"> *</font>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control validarNumerosLetras" id="txt_documento"
                                        placeholder="INGRESAR CEDULA/RUC" autocomplete="off"
                                        style="text-transform: uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
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
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA GENERO-->
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
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- ENTRADA PARA FECHA DE NACIMIENTO -->
                            <div class="form-group">
                                <label for="txt_fecha_nacimiento" class="control-label"
                                    style="text-align: right;">F.NACIMIENTO
                                    <font color="red"> *</font>
                                </label>
                                <input type="date" class="form-control" id="txt_fecha_nacimiento" autocomplete="off">
                            </div>
                        </div>
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
                            <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                            <div class="form-group">
                                <label for="cbm_provincia" class="control-label" style="text-align: right;">PROVINCIA
                                    <font color="red"> *</font>
                                </label>
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
                                    placeholder="INGRESE CIUDAD" maxlength="100" autocomplete="off" style="text-transform: uppercase">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!-- ENTRADA PARA DIRECCION -->
                            <div class="form-group">
                                <label for="txt_direccion" class="control-label" style="text-align: right;">DIRECCION
                                    DOMICILIO<font color="red"> *</font>
                                </label>
                                <input type="text" class="form-control validarNumerosLetras" id="txt_direccion"
                                    placeholder="INGRESE DIRECCION" maxlength="50" autocomplete="off"
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
                                <select class="form-control cbm_ingreso_mensual" name="state" id="cbm_ingreso_mensual"
                                    style="width:100%;">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">CANCELAR</button>
                    <button type="submit" class="btn btn-primary" onclick="Modificar_Cliente()">MODIFICAR</button>
                </div>
                <!-- <div class="overlay">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div> -->
            </form>
        </div>
    </div>
</div>


<script src="js/clientes.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_cliente();
    listar_combo_provincia();
});
</script>
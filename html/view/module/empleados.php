<?php

if($_SESSION["S_ROL"] != "ADMINISTRADOR"){

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
                    <h1><?php echo $t('messages.manage_employees'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.manage_employees'); ?></li>
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
                <h3 class="card-title"><?php echo $t('messages.welcome_employee_content'); ?></h3>
                <div class="card-tools pull-right">
                <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;<?php echo $t('messages.new_record'); ?>
                        </i></b></button>
                </div>
            </div>
            <div class="card-body">
            <table id="tabla_empleado" class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Direcci&oacute;n</th>
                            <th style="text-align:center">Provincia</th>
                            <th style="text-align:center">Estado</th>
                            <th style="text-align:center">Acciones</th>
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
MODAL REGISTRO USUARIO
======================================-->


<div id="modal_registro" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">Registro De Empleado</h5>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL NOMBRE DE EMPLEADO -->
                        <div class="form-group">
                            <label for="txt_nombre_empleado" class="control-label" style="text-align: right;">NOMBRE
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetras" id="txt_nombre_empleado"
                                    placeholder="INGRESAR NOMBRES" maxlength="100" autocomplete="off"
                                    style="text-transform: uppercase">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL APELLIDO DE EMPLEADO -->
                        <div class="form-group">
                            <label for="txt_apellido_empleado" class="control-label" style="text-align: right;">APELLIDO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetras" id="txt_apellido_empleado"
                                    placeholder="INGRESAR APELLIDOS" maxlength="100" autocomplete="off"
                                    style="text-transform: uppercase">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                        <div class="form-group">
                            <label for="cbm_provincia" class="control-label" style="text-align: right;">PROVINCIA
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <select class="form-control cbm_provincia js-example-basic-single" name="state" id="cbm_provincia"
                                    style="width:100%;">
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA DIRECCION -->
                        <div class="form-group">
                            <label for="txt_direccion_empleado" class="control-label" style="text-align: right;">DIRECCI&Oacute;N
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <textarea class="form-control validarNumerosLetrasDecimal" id="txt_direccion_empleado" name="txt_direccion_empleado"
                            cols="20" rows="3" placeholder="Ingresar Dirección"></textarea>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-info pull-left" onclick="Registrar_Empleado()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--=====================================
CABEZA DEL MODAL
======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title"><b>Editar Datos Del Empleado</b></h4>
                </div>
                <!--=====================================
CUERPO DEL MODAL
======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <input type="hidden" id="txtidempleado">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <label for="txt_nombre_editar" class="control-label" style="text-align: right;">NOMBRE
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetras" id="txt_nombre_editar"
                                    placeholder="INGRESAR NOMBRE" autocomplete="off" style="text-transform: uppercase">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL APELLIDO -->
                        <div class="form-group">
                            <label for="txt_apellido_editar" class="control-label" style="text-align: right;">APELLIDO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetras" id="txt_apellido_editar"
                                    placeholder="INGRESAR APELLIDO" autocomplete="off" style="text-transform: uppercase">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR PROVINCIA -->
                        <div class="form-group">
                            <label for="cbm_provincia_editar" class="control-label" style="text-align: right;">PROVINCIA
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <select class="form-control cbm_provincia js-example-basic-single" name="state"
                                    id="cbm_provincia_editar" style="width:100%;">
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA DIRECCION -->
                        <div class="form-group">
                            <label for="txt_direccion_empleado_editar" class="control-label" style="text-align: right;">DIRECCI&Oacute;N
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <textarea class="form-control validarNumerosLetrasDecimal" id="txt_direccion_empleado_editar" name="txt_direccion_empleado_editar"
                            cols="20" rows="3" placeholder="Ingresar Dirección"></textarea>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Modificar_Empleado()"><i
                            class="fa fa-save"><b>&nbsp;ACTUALIZAR</b></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="js/validaciones.js?rev=<?php echo time();?>"></script>
<script src="js/empleado.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_empleado();
    listar_combo_provincia();
    $("#modal_registro").on('shown.bs.modal', function() {
        $("#txt_nombre_empleado").focus();
    });
});
</script>
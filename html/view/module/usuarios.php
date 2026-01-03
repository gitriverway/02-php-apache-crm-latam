<?php

if ($_SESSION["S_ROL"] != "ADMINISTRADOR") {

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
                    <h1><?php echo $t('messages.manage_users'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.manage_users'); ?></li>
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
                <h3 class="card-title"><?php echo $t('messages.welcome_user_content'); ?></h3>
                <div class="card-tools pull-right">
                    <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i class="fa fa-plus"><b>&nbsp;<?php echo $t('messages.new_record'); ?>
                                </i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_usuario" class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th style="text-align:center">Imagen</th>
                            <th style="text-align:center">Usuario</th>
                            <th style="text-align:center">Rol</th>
                            <th style="text-align:center">Empleado</th>
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
                    <h5 class="modal-title">Registro De Usuario</h5>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <label for="txt_usu" class="control-label" style="text-align: right;">USUARIO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetras" id="txt_usu" placeholder="<?php echo $t('messages.enter_user'); ?>" maxlength="30" autocomplete="off" style="text-transform: uppercase">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA CONTRASEÑA -->
                        <div class="form-group">
                            <label for="txt_con1" class="control-label" style="text-align: right;">CONTRASE&Ntilde;A
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control validarNumerosLetras" id="txt_con1" placeholder="<?php echo $t('messages.enter_password'); ?>" maxlength="30">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA REPETIR CONTRASEÑA -->
                        <div class="form-group">
                            <label for="txt_con2" class="control-label" style="text-align: right;">REPITA
                                LA
                                CONTRASE&Ntilde;A<font color="red"> *</font></label>
                            <div class="input-group">
                                <input type="password" class="form-control validarNumerosLetras" id="txt_con2" placeholder="<?php echo $t('messages.repeat_password'); ?>" maxlength="30">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EMAIL -->
                        <div class="form-group">
                            <label for="txt_con2" class="control-label" style="text-align: right;">EMAIL
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="txt_email" placeholder="<?php echo $t('messages.enter_email'); ?>" maxlength="50" autocomplete="off">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR EMPLEADO -->
                        <div class="form-group">
                            <label for="cbm_empleado" class="control-label" style="text-align: right;">EMPLEADO
                            </label>
                            <div class="input-group">
                                <select class="form-control cbm_empleado js-example-basic-single" name="state" id="cbm_empleado" style="width:100%;">
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR ROL -->
                        <div class="form-group">
                            <label for="cbm_rol" class="control-label" style="text-align: right;">ROL
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <select class="form-control cbm_rol js-example-basic-single" name="state" id="cbm_rol" style="width:100%;">
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Registrar_Usuario()"><i class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--=====================================
CABEZA DEL MODAL
======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">Editar Datos Del Usuario</h5>
                </div>
                <!--=====================================
CUERPO DEL MODAL
======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <input type="hidden" id="txtidusuario">
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <label for="txtusu_editar" class="control-label" style="text-align: right;">USUARIO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control validarNumerosLetras" id="txtusu_editar" placeholder="INGRESAR USUARIO" autocomplete="off" style="text-transform: uppercase" disabled>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA CONTRASEÑA -->
                        <div class="form-group">
                            <label for="txt_con_editar" class="control-label" style="text-align: right;">CONTRASE&Ntilde;A NUEVA</label>
                            <div class="input-group">
                                <input type="password" class="form-control validarNumerosLetras" id="txt_con_editar" placeholder="<?php echo $t('messages.new_password'); ?>" maxlength="30">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <input type="hidden" id="passwordActual" name="passwordActual">
                            </div>
                        </div>

                        <!-- ENTRADA PARA EMAIL -->
                        <div class="form-group">
                            <label for="txtusu_email" class="control-label" style="text-align: right;">EMAIL
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="txtusu_email" placeholder="<?php echo $t('messages.enter_email'); ?>" maxlength="50" autocomplete="off">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR EMPLEADO -->
                        <div class="form-group">
                            <label for="cbm_empleado_editar" class="control-label" style="text-align: right;">EMPLEADO</label>
                            <div class="input-group">
                                <select class="form-control cbm_empleado js-example-basic-single" name="state" id="cbm_empleado_editar" style="width:100%;">
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR ROL -->
                        <div class="form-group">
                            <label for="cbm_rol" class="control-label" style="text-align: right;">ROL
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <select class="form-control cbm_rol js-example-basic-single" name="state" id="cbm_rol_editar" style="width:100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Modificar_Usuario()"><i class="fa fa-save"><b>&nbsp;ACTUALIZAR</b></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/usuario.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_usuario();
        listar_combo_empleado();
        listar_combo_rol();
        $("#modal_registro").on('shown.bs.modal', function() {
            $("#txt_usu").focus();
        });
    });
</script>
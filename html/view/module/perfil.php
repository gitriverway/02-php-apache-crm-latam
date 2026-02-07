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
                    <h1><?php echo $t('common.profile'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('common.profile'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-8">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="view/dist/img/avatar5.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                <?php
                                if ($_SESSION['S_EMPLEADO'] == null) {
                                    echo $_SESSION['S_USER'];
                                } else {
                                    echo $_SESSION['S_EMPLEADO'];
                                }
                                ?>
                            </h3>

                            <p class="text-muted text-center">
                                <?php
                                echo $_SESSION['S_ROL'];
                                ?>
                            </p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- ENTRADA PARA CONTRASEÑA -->
                            <div class="form-group">
                                <label for="txt_con1" class="control-label" style="text-align: right;">CONTRASE&Ntilde;A
                                    <font color="red"> *</font>
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control validarNumerosLetras" id="txt_con1" placeholder="<?php echo $t('messages.enter_password'); ?>" maxlength="30">
                                    <div class="input-group-append">
                                        <button id="show_password1" class="btn btn-default" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- ENTRADA PARA REPETIR CONTRASEÑA -->
                            <div class="form-group">
                                <label for="txt_con2" class="control-label" style="text-align: right;">REPITA
                                    LA
                                    CONTRASE&Ntilde;A<font color="red"> *</font></label>
                                <div class="input-group">
                                    <input type="password" class="form-control validarNumerosLetras" id="txt_con2" placeholder="<?php echo $t('messages.repeat_password'); ?>" maxlength="30">
                                    <div class="input-group-append">
                                        <button id="show_password2" class="btn btn-default" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary btn-block" onclick="Actualizar_password()"><i class="fa fa-save"><b>&nbsp;ACTUALIZAR</b></i></button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src="js/perfil.js?rev=<?php echo time(); ?>"></script>
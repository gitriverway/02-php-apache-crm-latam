<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

// Establecer idioma por defecto si no existe
if (!isset($_SESSION['S_IDIOMA'])) {
    $_SESSION['S_IDIOMA'] = 'en';
}
?>
<div class="login-box">
    <div class="card card-outline card-primary" id="card-forgot-password">
        <div class="card-header text-center">
            <a href="" class="h1"><img src="view/dist/img/riverway-solutions.png" alt="Riverway Solutions"
                    style="width: 150px; height: auto;"></a>
        </div>
        <div class="card-header text-center">
            <a href="" class="h1"><b><?php echo $t('common.change_password'); ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg"><?php echo $t('common.change_password_message'); ?>
            </p>
            <input hidden type="text" id="txt_usuarios"
                value="<?php echo isset($_GET['usuarios']) ? htmlspecialchars($_GET['usuarios']) : 'vacio'; ?>">


            <!-- ENTRADA PARA CONTRASEÑA -->
            <div class="form-group">
                <label for="txt_con1" class="control-label"
                    style="text-align: right;"><?php echo $t('common.new_password'); ?>
                    <font color="red"> *</font>
                </label>
                <div class="input-group">
                    <input type="password" class="form-control validarNumerosLetras" id="txt_con1"
                        placeholder="<?php echo $t('common.new_password'); ?>" maxlength="30">
                    <div class="input-group-append">
                        <button id="show_password1" class="btn btn-default" type="button"
                            onclick="mostrarPasswordChange()">
                            <span class="fa fa-eye-slash icon"></span> </button>
                    </div>
                </div>
            </div>
            <!-- ENTRADA PARA REPETIR CONTRASEÑA -->
            <div class="form-group">
                <label for="txt_con2" class="control-label"
                    style="text-align: right;"><?php echo $t('common.repeat_password'); ?><font color="red"> *</font>
                </label>
                <div class="input-group">
                    <input type="password" class="form-control validarNumerosLetras" id="txt_con2"
                        placeholder="<?php echo $t('common.repeat_password'); ?>" maxlength="30">
                    <div class="input-group-append">
                        <button id="show_password2" class="btn btn-default" type="button"
                            onclick="mostrarPasswordChange()">
                            <span class="fa fa-eye-slash icon"></span> </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block"
                        onclick="actualizar_contrasena()"><?php echo $t('common.update_password'); ?></button>
                </div>
                <!-- /.col -->
            </div>
            <p class="mt-3 mb-1">
                <a href="login"><?php echo $t('common.login'); ?></a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<script src=" js/login.js?rev=<?php echo time(); ?>"></script>
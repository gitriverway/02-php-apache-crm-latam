<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
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
            <a href="" class="h1"><b><?php echo $t('common.recover_password'); ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg"><?php echo $t('common.forgot_password_message'); ?></p>
            <div class="input-group mb-3">
                <input id="usuario" type="text" class="form-control" placeholder="<?php echo $t('common.user'); ?>"
                    autocomplete="off">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block"
                        onclick="recuperar_contrasena()"><?php echo $t('common.recover_password'); ?></button>
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
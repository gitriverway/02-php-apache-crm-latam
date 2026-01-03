<div class="login-box">
    <div class="card card-outline card-primary" id="card-forgot-password">
        <div class="card-header text-center">
            <a href="" class="h1"><b>Recuperar Contraseña</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente una nueva contraseña.</p>
            <div class="input-group mb-3">
                <input id="usuario" type="text" class="form-control" placeholder="Usuario" autocomplete="off">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block" onclick="recuperar_contrasena()">Recupera contraseña</button>
                </div>
                <!-- /.col -->
            </div>
            <p class="mt-3 mb-1">
                <a href="login">Inicar Sesión</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<script src=" js/login.js?rev=<?php echo time(); ?>"></script>
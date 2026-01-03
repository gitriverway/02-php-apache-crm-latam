<div class="login-box">
    <div class="card card-outline card-primary" id="card-forgot-password">
        <div class="card-header text-center">
            <a href="" class="h1"><b>Actualizar Contraseña</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">¿Actualizar tu contraseña? Aquí puede actualizar fácilmente una nueva contraseña.
            </p>
            <input hidden type="text" id="txt_usuarios"
                value="<?php echo isset($_GET['usuarios']) ? htmlspecialchars($_GET['usuarios']) : 'vacio'; ?>">


            <!-- ENTRADA PARA CONTRASEÑA -->
            <div class="form-group">
                <label for="txt_con1" class="control-label" style="text-align: right;">NUEVA CONTRASE&Ntilde;A
                    <font color="red"> *</font>
                </label>
                <div class="input-group">
                    <input type="password" class="form-control validarNumerosLetras" id="txt_con1"
                        placeholder="INGRESE CONTRASE&Ntilde;A" maxlength="30">
                    <div class="input-group-append">
                        <button id="show_password1" class="btn btn-default" type="button"
                            onclick="mostrarPasswordChange()">
                            <span class="fa fa-eye-slash icon"></span> </button>
                    </div>
                </div>
            </div>
            <!-- ENTRADA PARA REPETIR CONTRASEÑA -->
            <div class="form-group">
                <label for="txt_con2" class="control-label" style="text-align: right;">REPITA
                    LA NUEVA
                    CONTRASE&Ntilde;A<font color="red"> *</font></label>
                <div class="input-group">
                    <input type="password" class="form-control validarNumerosLetras" id="txt_con2"
                        placeholder="REPITA NUEVA CONTRASE&Ntilde;A" maxlength="30">
                    <div class="input-group-append">
                        <button id="show_password2" class="btn btn-default" type="button"
                            onclick="mostrarPasswordChange()">
                            <span class="fa fa-eye-slash icon"></span> </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block" onclick="actualizar_contrasena()">Actualizar
                        contraseña</button>
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
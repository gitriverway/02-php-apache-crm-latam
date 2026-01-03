<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function($key) {
    return Modelo_Idioma::t($key);
};

// Establecer idioma por defecto si no existe
if (!isset($_SESSION['S_IDIOMA'])) {
    $_SESSION['S_IDIOMA'] = 'en';
}
$currentLang = Modelo_Idioma::getCurrentLanguage();
?>
<div class="login-box">
  <!-- Language Selector -->
  <div style="position: absolute; top: 10px; right: 10px;">
    <select id="selector_idioma_login" class="form-control form-control-sm" style="width: auto;">
      <option value="en" <?php echo $currentLang == 'en' ? 'selected' : ''; ?>>🇺🇸 English</option>
      <option value="es" <?php echo $currentLang == 'es' ? 'selected' : ''; ?>>🇪🇸 Español</option>
      <option value="pt-BR" <?php echo $currentLang == 'pt-BR' ? 'selected' : ''; ?>>🇧🇷 Português</option>
    </select>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b><?php echo $t('common.login'); ?></b></a>
    </div>
    <div class="card-body">
      <form autocomplete="false" onsubmit="return false">
        <div class="input-group mb-3">
          <input id="usuario" type="text" class="form-control" placeholder="<?php echo $t('common.user'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control" placeholder="<?php echo $t('common.password'); ?>">
          <div class="input-group-append">
            <button id="show_password" class="btn btn-default" type="button"> <span
                class="fas fa-lock icon"></span> </button>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button class="btn btn-primary btn-block" onclick="Verificar_Usuario()"><?php echo $t('common.enter'); ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password"><?php echo $t('common.forgot_password'); ?></a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<script src=" js/login.js?rev=<?php echo time(); ?>"></script>
<script>
  $("#usuario").val();
  usuario.focus();
  
  // Manejar cambio de idioma en login
  $('#selector_idioma_login').on('change', function() {
    var nuevoIdioma = $(this).val();
    cambiarIdioma(nuevoIdioma);
  });
</script>
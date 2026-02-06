<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; <?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
}; echo date('Y'); ?> <a href="#">SINI-OKëN</a>.</strong> <?php echo $t('common.all_rights_reserved'); ?>
  </footer>
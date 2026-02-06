  <?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1><?php echo $t('error.page_404'); ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                           <li class="breadcrumb-item active"><?php echo $t('error.page_404'); ?></li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="error-page">
              <h2 class="headline text-warning"> 404</h2>

              <div class="error-content">
                  <h3><i class="fas fa-exclamation-triangle text-warning"></i> <?php echo $t('error.page_not_found'); ?></h3>

                  <p>
<?php echo $t('error.page_not_found_message'); ?>
                       Meanwhile, you may <a href="inicio"><?php echo $t('error.return_dashboard'); ?></a> or try using the search
                       form.
                  </p>

                  <form class="search-form">
                      <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="<?php echo $t('common.search'); ?>">

                          <div class="input-group-append">
                              <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                              </button>
                          </div>
                      </div>
                      <!-- /.input-group -->
                  </form>
              </div>
              <!-- /.error-content -->
          </div>
          <!-- /.error-page -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
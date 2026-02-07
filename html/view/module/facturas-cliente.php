<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

if($_SESSION["S_ROL"] != "CLIENTE"){

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
                <div class="col-sm-6">
<h1><?php echo $t('messages.client_invoices'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.manage_client_invoices'); ?></li>
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
                <h3 class="card-title"><?php echo $t('messages.welcome_client_invoices_content'); ?></h3>
            </div>
            <div class="card-body">
                <table id="tabla-factura-cliente" class="table table-bordered table-striped"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
<th style="text-align:center; width:10px"><?php echo $t('list_tables.document_number'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.name'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.invoice_number'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.emission_date'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.invoice_value'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.invoice_balance'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.status'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.action'); ?></th>
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

<script src="js/validaciones.js?rev=<?php echo time();?>"></script>
<script src="js/factura-cliente.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_factura_cliente();
});
</script>
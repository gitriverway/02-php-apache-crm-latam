<?php

require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

if ($_SESSION["S_ROL"] == "CLIENTE") {

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
                    <h1> <?php echo $t('common.emisions_menage'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('common.emisions_menage'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <table id="tabla_cliente" class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.origin'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.action'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.status'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.effective_date'); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.anniversary_date'); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.holder'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.id_card'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.province'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.city'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.phone'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.email'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.provider'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.branch'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.employee'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.follow_up_date'); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.profession'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.income'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.sum_insured'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.net_premium'); ?></th>
                            <th style="text-align:center; width:10px">
                                <?php echo $t('list_tables.commissionable_premium'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.total_premium'); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.payment_type'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.payment_method'); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.sale_year'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('list_tables.sale_month'); ?></th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idBayer" value="0">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
<?php echo $t('modal.assign_seller'); ?>
======================================-->
<div id="modal_asignar_vendedor" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('list_modal.list_sellers'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabla_lista_vendedores" class="table table-bordered table-striped dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center; width:10px">#</th>
                                <th style="text-align:center; width:10px"><?php echo $t('list_tables.seller'); ?></th>
                                <th style="text-align:center; width:10px"><?php echo $t('list_tables.cargo'); ?></th>
                                <th style="text-align:center; width:10px"><?php echo $t('list_tables.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL LISTAR CONTRATOS
======================================-->
<div id="modal_listar_contratos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('list_modal.list_documents'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabla_lista_contratos" class="table table-bordered table-striped dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center; width:10px">#</th>
                                <th style="text-align:center; width:10px"><?php echo $t('list_tables.document'); ?></th>
                                <th style="text-align:center; width:10px">
                                    <?php echo $t('list_tables.registration_date'); ?></th>
                                <th style="text-align:center; width:10px"> <?php echo $t('list_tables.status'); ?> </th>
                                <th style="text-align:center; width:10px"><?php echo $t('list_tables.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/clientes-hogar-individual.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_cliente();
        listar_vendedores();
    });
</script>
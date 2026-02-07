<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

if ($_SESSION["S_ROL"] != "CLIENTE") {

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
                    <h1><?php echo $t("common.manage_life_collective_contracts_pymes"); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t("common.home"); ?></a></li>
                        <li class="breadcrumb-item active">
                            <?php echo $t("common.manage_life_collective_contracts_pymes"); ?></li>
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
                <table id="tabla-contrato-cliente" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.contract_number"); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.effective_date"); ?>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.anniversary_date"); ?>
                            </th>
                            <th style="text-align:center; width:10px">
                                <?php echo $t("list_tables.provider"); ?>/<?php echo $t("list_tables.branch"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.sum_insured"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.id_card"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.quotation"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.nomination_letter"); ?>
                            </th>
                            <th style="text-align:center; width:10px">
                                <?php echo $t("list_tables.affiliation_request"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.contract"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.invoice"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.bank_debit"); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t("list_tables.status"); ?></th>
                        </tr>
                    </thead>
                </table>
                <input type="hidden" id="txt_idCliente" value="0">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="js/validaciones.js?rev=<?php echo time(); ?>"></script>
<script src="js/contrato-vida-individual-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
$(document).ready(function() {
    listar_contrato_cliente();
});
</script>
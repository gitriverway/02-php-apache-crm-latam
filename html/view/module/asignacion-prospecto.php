<?php

if ($_SESSION["S_ROL"] == "CLIENTE") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>
<link rel="stylesheet" href="../css/table-responsive.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <?php
                require_once __DIR__ . '/../../model/modelo_idioma.php';
                $t = function ($key) {
                    return Modelo_Idioma::t($key);
                };
                ?>
                <div class="col-sm-6">
                    <h1><?php echo $t('messages.web_prospect_assignment'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $t('messages.manage_web_assignment'); ?></li>
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
                <table id="tabla_asignacion" class="table table-bordered table-striped">
                    <thead>
                        <?php if ($_SESSION["S_ROL"] === "GERENTE") : ?>
                            <tr>
                                <th colspan="18">
                                    <button style="width:100%" id="btnListaVendedor" class="form-control btn btn-primary">
                                        <?= $t('messages.assign'); ?>
                                    </button>
                                </th>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            <th style="text-align:center; width:10px">
                                <div class="form-check">
                                    <!-- <input class="form-check-input chkSeleccionarTodoAsignar"
                                        id="chkSeleccionarTodoAsignar" name="chkSeleccionarTodoAsignar"
                                        type="checkbox"> -->
                                    <label class="form-check-label"><?php echo $t('messages.select_all'); ?></label>
                                </div>
                            </th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.bayer_status'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.seller'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.prospect'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.chat'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.id_card_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.branches'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.products'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.province_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.phone_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.provider_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.plans'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.origin_table'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.year'); ?></th>
                            <th style="text-align:center; width:10px"><?php echo $t('messages.month_table'); ?></th>
                            <th style="text-align:center; width:10px">
                                <?php echo $t('messages.registration_date_table'); ?></th>
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

<!--=====================================
MODAL ASIGNAR VENDEDOR
======================================-->
<div id="modal_asignar_vendedor" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('messages.seller_list'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabla_lista_vendedores" class="table table-bordered table-striped dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:10px">#</th>
                                <th><?php echo $t('messages.seller'); ?></th>
                                <th><?php echo $t('messages.position'); ?></th>
                                <th><?php echo $t('messages.action_table'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL LISTAR CHAT PROSPECTO WEB
======================================-->
<div class="modal fade" id="modalChatWeb">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $t('messages.web_chat'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="listaChats">
                <div class="row" id="todoChats">

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="js/asignacion.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_asignacion();
        listar_vendedores();
    });
</script>
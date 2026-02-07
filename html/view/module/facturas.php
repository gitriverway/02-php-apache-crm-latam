<?php

if($_SESSION["S_ROL"] != "ADMINISTRADOR" && $_SESSION["S_ROL"] != "GERENTE" && $_SESSION["S_ROL"] != "VENDEDOR"){

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
                <?php
                require_once __DIR__ . '/../../model/modelo_idioma.php';
                $t = function($key) {
                    return Modelo_Idioma::t($key);
                };
                ?>
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
                <div class="card-tools pull-right">
                    <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;<?php echo $t('messages.new_record'); ?>
                        </i></b></button>
                </div>
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
                <input type="hidden" id="txt_idCliente" value="0">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
MODAL NUEVA FACTURA
======================================-->
<div id="modalAgregarFactura" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title"><?php echo $t('buttons.new_invoice'); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group col-12 col-md-6">
                            <label for="txt_documento" class="control-label" style="text-align: right;">CEDULA/RUC
                                <font color="red"> *</font>
                            </label>
                            <input type="text" class="form-control" id="txt_documento" name="txt_documento"
                                placeholder="CEDULA/RUC">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="txt_nombre" class="control-label" style="text-align: right;">NOMBRE
                                <font color="red"> *</font>
                            </label>
                            <input type="text" class="form-control" id="txt_nombre" name="txt_nombre"
                                placeholder="NOMBRE" style="text-transform: uppercase">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="txt_numero_factura" class="control-label" style="text-align: right;">NUMERO
                                FACTURA
                                <font color="red"> *</font>
                            </label>
                            <input type="text" class="form-control" id="txt_numero_factura" name="txt_numero_factura"
                                placeholder="NUMERO FACTURA">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="txt_fecha_emision" class="control-label" style="text-align: right;">FECHA
                                EMISION
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control" id="txt_fecha_emision" name="txt_fecha_emision">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="txt_valor" class="control-label" style="text-align: right;">VALOR FACTURA
                                <font color="red"> *</font>
                            </label>
                            <input type="number" class="form-control validarNumerosDecimal" id="txt_valor" name="txt_valor" min="0"
                                placeholder="0">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="txt_numero_factura" class="control-label" style="text-align: right;">FORMA PAGO
                                <font color="red"> *</font>
                            </label>
                            <select class="form-control cbm_forma_pago" name="state" id="cbm_forma_pago"
                                style="width:100%;">
                                <option value=""><?php echo $t('messages.select_option', 'Select..'); ?></option>
<option value="DEBITO BANCARIO"><?php echo $t('form.bank_debit'); ?></option>
                                <option value="TRANSFERENCIA BANCARIO"><?php echo $t('form.bank_transfer'); ?></option>
                                <option value="TARJETA DE CREDITO"><?php echo $t('form.credit_card'); ?></option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_factura_documento" class="control-label" style="text-align: right;">FACTURA
                                DOCUMENTO
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_factura_documento"
                                name="txt_factura_documento" accept=".pdf">
                                <p class="help-block"><?php echo $t('form.max_image_size'); ?> <?php echo $t('form.image_mb_5'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="agregarNuevaFactura()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/validaciones.js?rev=<?php echo time();?>"></script>
<script src="js/facturas.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_factura_cliente();
    $("#modalAgregarFactura").on('shown.bs.modal', function() {
        $("#txt_documento").focus();
    });
});
</script>
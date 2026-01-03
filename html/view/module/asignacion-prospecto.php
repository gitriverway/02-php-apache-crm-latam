<?php

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
                <?php
                require_once __DIR__ . '/../../model/modelo_idioma.php';
                $t = function($key) {
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
                        <?php

                        if ($_SESSION["S_ROL"] == "GERENTE") {

                            echo '<tr>
                            <th colspan="18">
                                <button style="width:100%" id="btnListaVendedor"
                                    class="form-control btn btn-primary"><?php echo $t('messages.assign'); ?></button>
                            </th>
                        </tr>';
                        }

                        ?>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            <th style="text-align:center; width:10px">
                                <div class="form-check">
                                    <!-- <input class="form-check-input chkSeleccionarTodoAsignar"
                                        id="chkSeleccionarTodoAsignar" name="chkSeleccionarTodoAsignar"
                                        type="checkbox"> -->
                                    <label class="form-check-label">Seleccionar Todo</label>
                                </div>
                            </th>
                            <th style="text-align:center; width:10px">Estado Bayer</th>
                            <th style="text-align:center; width:10px">Vendedor</th>
                            <th style="text-align:center; width:10px">Prospecto</th>
                            <th style="text-align:center; width:10px">Chat</th>
                            <th style="text-align:center; width:10px">Cédula</th>
                            <th style="text-align:center; width:150px">Ramos</th>
                            <th style="text-align:center; width:150px">Productos</th>
                            <th style="text-align:center; width:10px">Provincia</th>
                            <th style="text-align:center; width:10px">Telefono</th>
                            <th style="text-align:center; width:10px">Proveedor</th>
                            <th style="text-align:center; width:10px">Planes</th>
                            <th style="text-align:center; width:10px">Origen</th>
                            <th style="text-align:center; width:10px">Año</th>
                            <th style="text-align:center; width:10px">Mes</th>
                            <th style="text-align:center; width:10px">F.Registro</th>
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
                    <h5 class="modal-title">Lista de Vendedores</h5>
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
                                <th>Vendedor</th>
                                <th>Cargo</th>
                                <th>Acci&oacute;n</th>
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
                <h4 class="modal-title">Chat Web</h4>
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
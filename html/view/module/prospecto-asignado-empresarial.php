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
                <div class="col-sm-6">
                    <h1>Administrar Prospectos Pymes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Prospectos Pymes</li>
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
                <!-- <h3 class="card-title">BIENVENIDO AL CONTENIDO DE PROSPECTOS</h3> -->
                <div class="card-tools pull-right">
                    <a href="crear-prospecto-empresarial">
                        <button class="btn btn-primary" style="width:100%"><i class="fa fa-plus"><b>&nbsp;Nuevo
                                    Registro</i></b></button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_prospecto_empresarial" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <?php

                        if ($_SESSION["S_ROL"] == "GERENTE") {

                            echo '<tr>
                            <th colspan="18">
                                <button style="width:100%" id="btnListaVendedor"
                                    class="form-control btn btn-primary">Asignar</button>
                            </th>
                        </tr>';
                        }

                        ?>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            <th style="text-align:center; width:10px">
                                <div class="form-check">
                                    <!-- <input class="form-check-input chkSeleccionarTodoAsignar" id="chkSeleccionarTodoAsignar" name="chkSeleccionarTodoAsignar" type="checkbox"> -->
                                    <label class="form-check-label">Seleccionar Todo</label>
                                </div>
                            </th>
                            <th style="text-align:center; width:10px">Estado Bayer</th>
                            <th style="text-align:center; width:10px">Vendedor</th>
                            <th style="text-align:center; width:10px">Prospecto</th>
                            <th style="text-align:center; width:10px">Cédula</th>
                            <th style="text-align:center; width:10px">Fecha Seguimiento</th>
                            <th style="text-align:center; width:150px">Ramos</th>
                            <th style="text-align:center; width:150px">Productos</th>
                            <th style="text-align:center; width:10px">Provincia</th>
                            <th style="text-align:center; width:10px">Telefono</th>
                            <th style="text-align:center; width:10px">Proveedor</th>
                            <th style="text-align:center; width:10px">Planes</th>
                            <th style="text-align:center; width:10px">Origen</th>
                            <th style="text-align:center; width:10px">Año</th>
                            <th style="text-align:center; width:10px">Mes</th>
                            <th style="text-align:center; width:10px">Fecha Registro</th>
                        </tr>
                    </thead>
                </table>
                <input type="text" id="txt_idProspecto" name="txt_idProspecto" hidden>
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
MODAL MODIFICAR ESTADO BAYER PERSONA
======================================-->

<div id="modal_estado_bayer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">Modifcar estado Bayer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA SELECCIONAR EMPLEADO -->
                        <div class="form-group">
                            <label for="cbm_estado_bayer" class="control-label" style="text-align: right;">ESTADO
                                BAYER
                            </label>
                            <select class="form-control cbm_estado_bayer js-example-basic-single" name="state"
                                id="cbm_estado_bayer" style="width:100%;">
                                <option value="ABIERTO">ABIERTO</option>
                                <!-- <option value="NO CONTESTA">NO CONTESTA</option> -->
                                <option value="NO INTERESADO">NO INTERESADO</option>
                                <option value="INTERESADO">INTERESADO</option>
                                <option value="INTERESADO ALTO">INTERESADO ALTO</option>
                                <option value="INTERESADO MEDIO">INTERESADO MEDIO</option>
                                <option value="INTERESADO BAJO">INTERESADO BAJO</option>
                                <option value="CONTRATADO">CONTRATADO</option>
                                <option value="DUPLICADO">DUPLICADO</option>
                                <option value="NO RECUPERADO">NO RECUPERADO</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info pull-left" onclick="Modificar_Estado_Bayer_Cliente()"><i
                            class="fa fa-save"><b>&nbsp;ACTUALIZAR</b></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/prospecto-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
$(document).ready(function() {
    listar_prospecto_empresarial();
    listar_vendedores();
});
</script>
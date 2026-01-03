<?php

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
                    <h1>Clientes Vida Individual
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes Vida Individual</li>
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
                <h3 class="card-title">BIENVENIDO AL CONTENIDO DE REEMBOLSOS - VIDA INDIVIDUAL</h3>
                <div class="card-tools pull-right">
                    <button class="btn btn-primary" style="width:100%" onclick="AbrirModalRegistro()"><i
                            class="fa fa-plus"><b>&nbsp;Nuevo
                                Registro</i></b></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla-listar-reembolsos-vida-individual"
                    class="table table-bordered table-striped dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Nombre</th>
                            <th style="text-align:center; width:10px">Contrato</th>
                            <th style="text-align:center; width:10px">Fecha Registro</th>
                            <th style="text-align:center; width:10px">Fecha Modificacion</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
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
MODAL INGRESAR NUEVO REEMBOLSO
======================================-->
<div id="modalAgregarReembolso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">NUEVO REEMBOLSO - VIDA INDIVIDUAL</h5>
                </div>
                <div class="modal-body">
                    <div class="row nuevoDatosReembolso">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_contrato_aplicar" class="control-label" style="text-align: right;">CONTRATO
                                APLICAR
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="txt_contrato_aplicar"
                                    name="txt_contrato_aplicar" placeholder="CONTRATO" style="text-transform: uppercase"
                                    disabled>
                                <input type="hidden" id="txt_idBayer">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary btnListarContratos"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_nombre_paciente" class="control-label" style="text-align: right;">NOMBRE
                                PACIENTE
                                <font color="red"> *</font>
                            </label>
                            <input type="text" class="form-control nombre_paciente" id="txt_nombre_paciente"
                                name="txt_nombre_paciente" placeholder="NOMBRE PACIENTE"
                                style="text-transform: uppercase">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_fecha_atencion" class="control-label" style="text-align: right;">FECHA
                                ATENCION
                                <font color="red"> *</font>
                            </label>
                            <input type="date" class="form-control fecha_atencion" id="txt_fecha_atencion"
                                name="txt_fecha_atencion">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="txt_valor_presentado" class="control-label" style="text-align: right;">VALOR
                                REEMBOLSO
                                <font color="red"> *</font>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control valor_presentado validarNumerosDecimal"
                                    id="txt_valor_presentado" name="txt_valor_presentado" placeholder="0" min="0">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_lugar_atencion" class="control-label" style="text-align: right;">CENTRO
                                HOSPITALARIO
                                <font color="red"> *</font>
                            </label>
                            <input type="text" class="form-control lugar_atencion" id="txt_lugar_atencion"
                                name="txt_lugar_atencion" placeholder="CENTRO HOSPITALARIO"
                                style="text-transform: uppercase">
                        </div>
                        <div class="form-group col-12">
                            <label for="txt_diagnostico" class="control-label" style="text-align: right;">DIAGNOSTICO
                                <font color="red"> *</font>
                            </label>
                            <textarea class="form-control diagnostico_reembolso validarNumerosLetrasDecimal"
                                id="txt_diagnostico" name="txt_diagnostico" cols="20" rows="3"
                                placeholder="Ingresar Diagnostico"></textarea>
                        </div>

                        <div class="form-group col-12">
                            <label for="txt_documento_reembolso" class="control-label"
                                style="text-align: right;">DOCUMENTOS
                                <font color="red"> *</font>
                            </label>
                            <input type="file" class="form-control" id="txt_documento_reembolso"
                                name="txt_documento_reembolso" accept=".pdf">
                            <p class="help-block">Peso máximo de la imagen 5MB</p>
                        </div>
                        <input type="hidden" id="listaDatosReembolso">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i
                            class="fa fa-times"><b>&nbsp;CERRAR</b></i></button>

                    <button type="button" class="btn btn-primary" onclick="Registrar_Reembolso()"><i
                            class="fa fa-save"><b>&nbsp;REGISTRAR</b></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalListarContratosClientes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="false" onsubmit="return false" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h5 class="modal-title">LISTA CONTRATOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table id="table_listar_contratos_cliente"
                            class="table table-bordered table-striped dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:10px">#</th>
                                    <th style="text-align:center; width:10px">Cedula/Ruc</th>
                                    <th style="text-align:center; width:10px">Cliente</th>
                                    <th style="text-align:center; width:10px">Contrato</th>
                                    <th style="text-align:center; width:10px">Acci&oacute;n</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/reembolsos-vida-individual-cliente.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_reembolsos_cliente_vida_individual();
    listar_contratos_para_seleccionar();
});
</script>
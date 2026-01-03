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
                    <h1>Emisiones Accidentes Personales Pymes
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Emisiones Accidentes Personales Pymes</li>
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
                <table id="tabla_cliente_pymes" class="table table-bordered table-striped dt-responsive"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Origen</th>
                            <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            <th style="text-align:center; width:10px">Estado</th>
                            <th style="text-align:center; width:10px">Fecha Vigencia</th>
                            <th style="text-align:center; width:10px">Fecha Aniversario</th>
                            <th style="text-align:center; width:10px">Titular</th>
                            <th style="text-align:center; width:10px">Cédula</th>
                            <th style="text-align:center; width:10px">Provincia</th>
                            <th style="text-align:center; width:10px">Ciudad</th>
                            <th style="text-align:center; width:10px">Telefono</th>
                            <th style="text-align:center; width:10px">Email</th>
                            <th style="text-align:center; width:10px">Proveedor</th>
                            <th style="text-align:center; width:10px">Planes</th>
                            <th style="text-align:center; width:10px">Vendedor</th>
                            <th style="text-align:center; width:10px">Fecha Seguimiento</th>
                            <th style="text-align:center; width:10px">Profesión</th>
                            <th style="text-align:center; width:10px">Ingresos</th>
                            <th style="text-align:center; width:10px">Valor Asegurado</th>
                            <th style="text-align:center; width:10px">Prima Neta</th>
                            <th style="text-align:center; width:10px">Prima Comisionable</th>
                            <th style="text-align:center; width:10px">Prima Total</th>
                            <th style="text-align:center; width:10px">Tipo Pago</th>
                            <th style="text-align:center; width:10px">Forma Pago</th>
                            <th style="text-align:center; width:10px">Año Venta</th>
                            <th style="text-align:center; width:10px">Mes Venta</th>
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
                                <th style="text-align:center; width:10px">#</th>
                                <th style="text-align:center; width:10px">Vendedor</th>
                                <th style="text-align:center; width:10px">Cargo</th>
                                <th style="text-align:center; width:10px">Acci&oacute;n</th>
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
                    <h5 class="modal-title">Lista de Documentos</h5>
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
                                <th style="text-align:center; width:10px">Documento</th>
                                <th style="text-align:center; width:10px">Fecha Registro</th>
                                <th style="text-align:center; width:10px">Estado</th>
                                <th style="text-align:center; width:10px">Acci&oacute;n</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/clientes-accidentes-personales-individual-empresarial.js?rev=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        listar_cliente_pymes();
        listar_vendedores();
    });
</script>
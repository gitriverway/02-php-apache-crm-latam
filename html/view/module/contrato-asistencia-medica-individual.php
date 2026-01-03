<?php

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
                    <h1>Contratos Asistencia Medica Individual
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Contratos Asistencia Medica Individual</li>
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
                            <th style="text-align:center; width:10px">N° Contrato</th>
                            <th style="text-align:center; width:10px">Fecha Vigencia</th>
                            <th style="text-align:center; width:10px">Fecha Aniversario</th>
                            <th style="text-align:center; width:10px">Proveedor/Plan</th>
                            <th style="text-align:center; width:10px">Valor Asegurado</th>
                            <th style="text-align:center; width:10px">Cedula</th>
                            <th style="text-align:center; width:10px">Cotizaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Carta Nombramiento</th>
                            <th style="text-align:center; width:10px">Solicitud Afiliaci&oacute;n</th>
                            <th style="text-align:center; width:10px">Contrato</th>
                            <th style="text-align:center; width:10px">Nueva Vigencia Contrato</th>
                            <th style="text-align:center; width:10px">Factura</th>
                            <th style="text-align:center; width:10px">Debito Bancario Actual</th>
                            <th style="text-align:center; width:10px">Estado</th>
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
<script src="js/contrato-asistencia-medica-individual.js?rev=<?php echo time(); ?>"></script>
<script>
$(document).ready(function() {
    listar_contrato_cliente();
});
</script>
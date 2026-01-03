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
                    <h1>Facturas Clientes
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Facturas Clientes</li>
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
                <h3 class="card-title">BIENVENIDO AL CONTENIDO DE FACTURAS CLIENTES</h3>
            </div>
            <div class="card-body">
                <table id="tabla-factura-cliente" class="table table-bordered table-striped"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:center; width:10px">#</th>
                            <th style="text-align:center; width:10px">Nº Documento</th>
                            <th style="text-align:center; width:10px">Nombre</th>
                            <th style="text-align:center; width:10px">N° Factura</th>
                            <th style="text-align:center; width:10px">Fecha Emision</th>
                            <th style="text-align:center; width:10px">Valor Factura</th>
                            <th style="text-align:center; width:10px">Saldo Factura</th>
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

<script src="js/validaciones.js?rev=<?php echo time();?>"></script>
<script src="js/factura-cliente.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    listar_factura_cliente();
});
</script>
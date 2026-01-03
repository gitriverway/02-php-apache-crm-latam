<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Individual</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                if ($_SESSION["S_ROL"] == 'GERENTE') {
                    include "cajas/administrativo/caja-prospecto-web-individual.php";
                }
                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'VENDEDOR') {
                    include "cajas/administrativo/caja-prospecto-individual.php";
                }

                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'SERVICIO CLIENTE') {
                    include "cajas/administrativo/caja-vida-individual.php";
                    include "cajas/administrativo/caja-asistencia-medica-individual.php";
                    include "cajas/administrativo/caja-vehiculo-individual.php";
                    include "cajas/administrativo/caja-accidentes-personales-individual.php";
                    include "cajas/administrativo/caja-hogar-individual.php";
                    include "cajas/administrativo/caja-responsabilidad-civil-individual.php";
                }
                ?>


            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pymes</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'VENDEDOR') {
                    include "cajas/administrativo/caja-prospecto-pymes.php";
                }

                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'SERVICIO CLIENTE') {
                    include "cajas/administrativo/caja-vida-pymes.php";
                    include "cajas/administrativo/caja-asistencia-medica-pymes.php";
                    include "cajas/administrativo/caja-accidentes-personales-pymes.php";
                    include "cajas/administrativo/caja-responsabilidad-civil-pymes.php";
                    include "cajas/administrativo/caja-incendio-pymes.php";
                    include "cajas/administrativo/caja-transporte-pymes.php";
                }

                ?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    contadoresGenerales();
    contadoresGeneralesServicios();
})
</script>
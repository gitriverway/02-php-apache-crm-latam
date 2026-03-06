<?php
require_once __DIR__ . '/../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo $t('common.single'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                if ($_SESSION["S_ROL"] == 'GERENTE') {
                    include __DIR__ . "/cajas/administrativo/caja-prospecto-web-individual.php";
                }
                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'VENDEDOR') {
                    include __DIR__ . "/cajas/administrativo/caja-prospecto-individual.php";
                }

                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'SERVICIO CLIENTE') {
                    // include __DIR__ . "/cajas/administrativo/caja-vida-individual.php";
                    include __DIR__ . "/cajas/administrativo/caja-asistencia-medica-individual.php";
                    // include __DIR__ . "/cajas/administrativo/caja-vehiculo-individual.php";
                    // include __DIR__ . "/cajas/administrativo/caja-accidentes-personales-individual.php";
                    // include __DIR__ . "/cajas/administrativo/caja-hogar-individual.php";
                    // include __DIR__ . "/cajas/administrativo/caja-responsabilidad-civil-individual.php";
                }
                ?>


            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo $t('common.pymes'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'VENDEDOR') {
                    include __DIR__ . "/cajas/administrativo/caja-prospecto-pymes.php";
                }

                if ($_SESSION["S_ROL"] == 'GERENTE' || $_SESSION["S_ROL"] == 'SERVICIO CLIENTE') {
                    // include __DIR__ . "/cajas/administrativo/caja-vida-pymes.php";
                    include __DIR__ . "/cajas/administrativo/caja-asistencia-medica-pymes.php";
                    // include __DIR__ . "/cajas/administrativo/caja-accidentes-personales-pymes.php";
                    // include __DIR__ . "/cajas/administrativo/caja-responsabilidad-civil-pymes.php";
                    // include __DIR__ . "/cajas/administrativo/caja-incendio-pymes.php";
                    // include __DIR__ . "/cajas/administrativo/caja-transporte-pymes.php";
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
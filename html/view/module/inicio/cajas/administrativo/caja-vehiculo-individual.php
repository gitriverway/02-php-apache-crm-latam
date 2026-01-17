<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-6 col-md-4 col-lg-3">
    <div class="small-box color-palette" style="background-color: #fcb7af;">
        <div class="inner">
            <h3 id="contadorContratoVehiculos1" class="contadorContratoVehiculos">0</h3>
            <p><?php echo $t("common.vehicles"); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-car"></i>
        </div>
        <a class="small-box-footer" href="#" data-toggle="modal" data-target="#modal-vehiculo-individual">
            <?php echo $t("common.more_info"); ?> <i class="fa fa-bars"></i>
        </a>

        <div class="modal fade" id="modal-vehiculo-individual">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo $t("common.vehicles"); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            include "vehiculo-individual/caja-emision.php";
                            if ($_SESSION["S_ROL"] == 'GERENTE') {
                                include "vehiculo-individual/caja-siniestro.php";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</div>
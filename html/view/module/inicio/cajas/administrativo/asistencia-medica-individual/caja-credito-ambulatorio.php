<?php
require_once __DIR__ . '/../../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12 col-lg-6">
    <div class=" small-box" style="background-color: #84b6f4;">
        <div class="inner">
            <h3 id="contadorCreditoAmbulatorio">0</h3>
            <p><?php echo $t('common.credit_ambulatory'); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-ambulance"></i>
        </div>
        <a href="credito-ambulatorio-asistencia-medica-individual"
            class="small-box-footer"><?php echo $t('common.more_info'); ?> <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
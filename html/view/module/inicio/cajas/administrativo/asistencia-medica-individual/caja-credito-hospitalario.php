<?php
require_once __DIR__ . '/../../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12 col-lg-6">
    <div class=" small-box" style="background-color: #fcb7af;">
        <div class="inner">
            <h3 id="contadorCreditoHospitalario">0</h3>
            <p><?php echo $t('common.credit_hospitalary'); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-hospital"></i>
        </div>
        <a href="operatorios-asistencia-medica-individual"
            class="small-box-footer"><?php echo $t('common.more_info'); ?>
            <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
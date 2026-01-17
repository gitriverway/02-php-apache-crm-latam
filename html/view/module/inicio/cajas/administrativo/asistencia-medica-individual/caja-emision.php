<?php
require_once __DIR__ . '/../../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12 col-lg-6">
    <div class=" small-box" style="background-color: #fdfd96;">
        <div class="inner">
            <h3 id="contadorContratoAsistenciaMedica2" class="contadorContratoAsistenciaMedica">0</h3>
            <p><?php echo $t('common.emisions'); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-medkit"></i>
        </div>
        <a href="clientes-asistencia-medica-individual" class="small-box-footer"><?php echo $t('common.more_info'); ?>
            <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
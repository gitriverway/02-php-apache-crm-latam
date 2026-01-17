<?php
require_once __DIR__ . '/../../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-6">
    <div class=" small-box" style="background-color: #fdfd96;">
        <div class="inner">
            <h3 id="contadorContratoTransportePymes2" class="contadorContratoTransportePymes">0
            </h3>
            <p><?php echo $t('common.emisions'); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-truck"></i>
        </div>
        <a href="clientes-transporte-empresarial" class="small-box-footer"><?php echo $t('common.more_info'); ?>
            info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
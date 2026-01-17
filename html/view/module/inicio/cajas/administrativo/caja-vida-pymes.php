<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-6 col-lg-3">
    <div class="small-box color-palette" style="background-color: #fdfd96;">
        <div class="inner">
            <h3 id="contadorContratoVidaEmpresarial">0</h3>

            <p><?php echo $t('common.life_collective'); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-heart"></i>
        </div>
        <a href="clientes-vida-individual-empresarial" class="small-box-footer"><?php echo $t('common.more_info'); ?> <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
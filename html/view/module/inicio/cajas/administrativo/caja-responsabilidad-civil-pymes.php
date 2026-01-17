<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-6 col-lg-3">
    <div class="small-box color-palette" style="background-color: #c7f7f7;">
        <div class="inner">
            <h3 id="contadorContratoResponsabilidadCivilPymes">0</h3>

            <p><?php echo $t("common.civil_liability"); ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-plus-square"></i>
        </div>
        <a href="clientes-responsabilidad-civil-empresarial"
            class="small-box-footer"><?php echo $t("common.more_info"); ?> <i info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
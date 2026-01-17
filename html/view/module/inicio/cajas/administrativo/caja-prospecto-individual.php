<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-6 col-md-4 col-lg-3">
    <div class="small-box" style="background-color: #77dd77;">
        <div class="inner">
            <h3 id="contadorProspecto">0</h3>
            <p><?php echo $t("common.prospects"); ?></p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <a href="prospecto-asignado" class="small-box-footer"><?php echo $t("common.more_info"); ?><i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
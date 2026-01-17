<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo $t('common.liability_insurance'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div class="bg-orange">
                        <a class="small-box" href="contrato-responsabilidad-civil-individual">
                            <div class="inner">
                                <h3 id="contadorContratosClienteResponsabilidadCivil" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.civil_liability_contracts'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-plus-square"></i>
                            </div>
                            <span class="small-box-footer"><?php echo $t('common.more_info'); ?> <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
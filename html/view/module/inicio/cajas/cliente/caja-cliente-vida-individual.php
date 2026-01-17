<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo $t('common.life_individual'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div class="bg-indigo">
                        <a class="small-box" href="contrato-vida-individual">
                            <div class="inner">
                                <h3 id="contadorContratosClienteVidaIndividual" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.individual_life_contracts'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-heart"></i>
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
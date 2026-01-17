<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo $t('common.fire_insurance'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div style="background-color: #fdfd96;">
                        <a class="small-box" href="contrato-incendios-pymes">
                            <div class="inner">
                                <h3 id="contadorContratosClienteIncendiosPymes" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.fire_insurance_contracts_pymes'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <span class="small-box-footer"><?php echo $t('common.more_info'); ?> <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div class="small-box" style="background-color: #fcb7af;">
                        <div class="inner">
                            <h3 id="contadorFormulariosClienteIncendiosPymes" style="color:black">0</h3>

                            <p style="color:black"><?php echo $t('common.fire_insurance_forms_pymes'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <a href="documento-incendios-pymes"
                            class="small-box-footer"><?php echo $t('common.more_info'); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div style="background-color: #84b6f4;">
                        <a class="small-box" href="siniestros-incendios-pymes-cliente">
                            <div class="inner">
                                <h3 id="contadorSiniestrosIncendiosPymes" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.fire_insurance_claims_pymes'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
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
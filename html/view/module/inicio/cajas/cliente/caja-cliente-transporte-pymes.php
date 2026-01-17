<?php
require_once __DIR__ . '/../../../../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
<div class="col-12">
    <div class="card">
        <div class="card-header" style="background-color: #007bff; color:#fff">
            <h3 class="card-title"><?php echo $t('common.transport_pymes'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div style="background-color: #fdfd96;">
                        <a class="small-box" href="contrato-transporte-pymes">
                            <div class="inner">
                                <h3 id="contadorContratosClienteTransportePymes" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.transport_contracts_pymes'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-car"></i>
                            </div>
                            <span class="small-box-footer"><?php echo $t('common.more_info'); ?> <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div style="background-color: #fcb7af;">
                        <a class="small-box" href="documento-transporte-pymes">
                            <div class="inner">
                                <h3 id="contadorFormulariosClienteTransportePymes" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.transport_forms_pymes'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-car"></i>
                            </div>
                            <span class="small-box-footer"><?php echo $t('common.more_info'); ?> <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <!-- small box -->
                    <div style="background-color: #84b6f4;">
                        <a class="small-box" href="siniestros-transporte-pymes-cliente">
                            <div class="inner">
                                <h3 id="contadorSiniestrosTransportePymes" style="color:black">0</h3>

                                <p style="color:black"><?php echo $t('common.transport_claims_pymes'); ?></p>
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
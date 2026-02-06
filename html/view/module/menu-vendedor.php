<?php
               require_once __DIR__ . '/../../model/modelo_idioma.php';
               $t = function ($key) {
                   return Modelo_Idioma::t($key);
               };
               
               if (isset($_GET["ruta"])) {
                   if ($_GET["ruta"] == "inicio") {
                    $retVal = "active";
                   } else {
                    $retVal = "";
                   }
                   
               } else {
                $retVal = "active";
               }
               
               ?>

                <li class="nav-item">
                    <a href="inicio" class="nav-link <?php  echo $retVal;?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?php echo $t('common.dashboard'); ?>
                        </p>
                    </a>
                </li>
<?php                       

                   ?>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            <?php echo $t('common.sales'); ?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    <?php echo $t('common.single'); ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prospecto-asignado" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?php echo $t('common.assigned_prospects'); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-prospecto" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?php echo $t('common.create_prospect'); ?></p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                <?php echo $t('common.pymes'); ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prospecto-asignado-empresarial" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
<p><?php echo $t('common.assigned_prospects'); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-prospecto-empresarial" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
<p><?php echo $t('common.create_prospect'); ?></p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php
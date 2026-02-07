                <?php
                require_once __DIR__ . '/../model/modelo_idioma.php';
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
                    <a href="inicio" class="nav-link <?php echo $retVal; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?php echo $t('menu.dashboard'); ?>
                        </p>
                    </a>
                </li>
                <?php

                $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "proveedores") ? "active" : "";

                echo '<li class="nav-item">
                                <a href="proveedores" class="nav-link ' . $retVal . '">
                                    <i class="nav-icon fa fa-user"></i>
                                    <p>
                                        ' . $t('menu.providers') . '
                                    </p>
                                </a>
                            </li>';

                echo '<li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fa fa-bookmark"></i>
                                <p>
                                ' . $t('menu.marketing') . '
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="asignacion-prospecto" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>' . $t('menu.web_assignment') . '</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                <a href="" class="nav-link">
                                                <i class="fas fa-th nav-icon"></i>
                                                <p>' . $t('menu.carteira') . '<i class="fas fa-angle-left right"></i></p>
                                            </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>' . $t('menu.individual') . '</p>
                                            </a>
                                        </li>
                                    </ul>
                            </li>
                            </ul>
                        </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            <p>
                            ' . $t('menu.sales') . '
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                            ' . $t('menu.individual') . '
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="prospecto-asignado" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                        <p>' . $t('menu.corporate_assigned_prospects') . '</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="crear-prospecto" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear Prospecto</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                ' . $t('menu.pymes') . '
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prospecto-asignado-empresarial" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('menu.assigned_prospects') . '</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-prospecto-empresarial" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('menu.create_prospect') . '</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        </ul>
                        </li>



                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-suitcase"></i>
                                    <p>
                                    ' . $t('menu.customer_service') . '
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-user"></i>
                                    <p>
                                        ' . $t('menu.individual') . '
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-medkit nav-icon"></i>
                                    <p>Asistencia Medica<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-asistencia-medica-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="reembolsos-asistencia-medica-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reembolsos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="operatorios-asistencia-medica-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crédito Hospitalario</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="credito-ambulatorio-asistencia-medica-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('menu.outpatient_credit') . '</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                            </li>

                            <li class="nav-item">
                    <a href="" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                ' . $t('menu.pymes') . '
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fa fa-medkit nav-icon"></i>
                                    <p>' . $t('menu.medical_assistance') . '<i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('menu.emissions') . ' y ' . $t('menu.renewals') . '</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="reembolsos-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('menu.reimbursements') . '</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="operatorios-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('menu.hospital_credit') . '</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="creditos-ambulatorios-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>' . $t('menu.outpatient_credit') . '</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>                            
                        </ul>
                        </li>

                        </ul>
                    </li>';
                ?>
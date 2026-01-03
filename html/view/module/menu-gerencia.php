                <?php
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
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php

                $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "proveedores") ? "active" : "";

                echo '<li class="nav-item">
                                <a href="proveedores" class="nav-link ' . $retVal . '">
                                    <i class="nav-icon fa fa-user"></i>
                                    <p>
                                        Proveedores
                                    </p>
                                </a>
                            </li>';

                echo '<li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fa fa-bookmark"></i>
                                <p>
                                Marketing
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="asignacion-prospecto" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignacion Web</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                <a href="" class="nav-link">
                                                <i class="fas fa-th nav-icon"></i>
                                                <p>Cartera<i class="fas fa-angle-left right"></i></p>
                                            </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Clientes</p>
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
                            Ventas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                            Individual
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="prospecto-asignado" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Prospectos Asignados</p>
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
                                Pymes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prospecto-asignado-empresarial" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Prospectos Asignados</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-prospecto-empresarial" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Prospecto</p>
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
                                    Servicio al cliente
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-user"></i>
                                    <p>
                                        Individual
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-heart nav-icon"></i>
                                    <p>Vida Individual<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-vida-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
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
                                            <p>Crédito Ambulatoria</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-car nav-icon"></i>
                                    <p>Vehiculos<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-vehiculo-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="siniestros-vehiculo-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Siniestros</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-plus-square nav-icon"></i>
                                    <p>Accidentes Personales<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-accidentes-personales-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-home nav-icon"></i>
                                    <p>Hogares<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-hogar-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="siniestros-hogar-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Siniestros</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-plus-square nav-icon"></i>
                                    <p>Responsabilidad Civil<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-responsabilidad-civil-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
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
                                Pymes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fa fa-heart nav-icon"></i>
                                        <p>Vida Colectiva<i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes-vida-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Emisiones y Renovaciones</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fa fa-medkit nav-icon"></i>
                                        <p>Asistencia Medica<i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Emisiones y Renovaciones</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="reembolsos-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Reembolsos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="operatorios-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crédito Hospitalario</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="creditos-ambulatorios-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crédito Ambulatorio</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-plus-square nav-icon"></i>
                                    <p>Accidentes Personales<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-accidentes-personales-individual-empresarial" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-plus-square nav-icon"></i>
                                    <p>Responsabilidad Civil<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-responsabilidad-civil-empresarial" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones y Renovaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                        </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="descragr_respaldo_bayer_persona()">
                            <i class="fa fa-plus-square nav-icon"></i>
                            <p>Respaldo Bayer Persona</p>
                        </a>
                    </li>';
                ?>
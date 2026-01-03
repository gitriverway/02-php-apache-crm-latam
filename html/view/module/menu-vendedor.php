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
                    <a href="inicio" class="nav-link <?php  echo $retVal;?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php                        

                    
                        echo '<li class="nav-item">
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
                        </li>';
                ?>
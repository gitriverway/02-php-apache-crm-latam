
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
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Individual
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">';

                        $retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado" || $_GET["ruta"] == "crear-prospecto")) ? "menu-is-opening menu-open" : "" ;

                        $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "prospecto-asignado") ? "active" : "" ;

                        echo '<li class="nav-item '.$retMenu.'">
                        <a href="" class="nav-link '.$retVal.'">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                            Ventas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="prospecto-asignado" class="nav-link '.$retVal.'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Prospectos Asignados</p>
                                </a>
                            </li>
                        </ul>
                    </li>';

                    echo '</ul>
                    </li>';


    
                        echo '<li class="nav-item">
                        <a href="" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Pymes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">';
    
                            $retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado-empresarial" || $_GET["ruta"] == "crear-prospecto-empresarial")) ? "menu-is-opening menu-open" : "" ;
    
                            $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "prospecto-asignado-empresarial") ? "active" : "" ;
    
                            echo '<li class="nav-item '.$retMenu.'">
                            <a href="" class="nav-link '.$retVal.'">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                Ventas
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prospecto-asignado-empresarial" class="nav-link '.$retVal.'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Prospectos Asignados</p>
                                    </a>
                                </li>
                            </ul>
                        </li>';
    
                        echo '</ul>
                        </li>';
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
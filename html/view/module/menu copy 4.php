<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
        <img src="view/dist/img/LogoMQP.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>MQP Seguros</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img id="img_lateral" src="view/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">
                    <?php 
                        if ($_SESSION['S_EMPLEADO'] == null) {
                            echo $_SESSION['S_USER'];
                        }else {
                            echo $_SESSION['S_EMPLEADO'];
                        }
                    ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

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
                    if($_SESSION["S_ROL"] == "ADMINISTRADOR"){

                    $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "usuarios") ? "active" : "" ;
                    
                        echo '<li class="nav-item">
                        <a href="usuarios" class="nav-link '.$retVal.' ">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>';
                        
                    }

                    if($_SESSION["S_ROL"] == "ADMINISTRADOR"){

                        $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "bloqueo-ip") ? "active" : "" ;
                        
                            echo '<li class="nav-item">
                            <a href="bloqueo-ip" class="nav-link '.$retVal.' ">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Bloqueo Ip
                                </p>
                            </a>
                        </li>';
                            
                    }
                        
                    if($_SESSION["S_ROL"] == "ADMINISTRADOR"){

                        $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "empleados") ? "active" : "" ;

                        echo '<li class="nav-item">
                        <a href="empleados" class="nav-link '.$retVal.'">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Empleados
                            </p>
                        </a>
                    </li>';
                        
                    }

                    if($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE"){

                        $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "proveedores") ? "active" : "" ;

                        echo '<li class="nav-item">
                        <a href="proveedores" class="nav-link '.$retVal.'">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Proveedores
                            </p>
                        </a>
                    </li>';
                        
                    }

                    echo '<li class="nav-item">
                    <a href="" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Individual
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">';

                    if($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE"){

                        $retMenu = (isset($_GET["ruta"]) && $_GET["ruta"] == "asignacion-prospecto") ? "menu-is-opening menu-open" : "" ;
                        $retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "asignacion-prospecto") ? "active" : "" ;

                        echo '<li class="nav-item '.$retMenu.'">
                        <a href="" class="nav-link '.$retVal.'">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                            Marketing
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="asignacion-prospecto" class="nav-link '.$retVal.'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asignacion Web</p>
                                </a>
                            </li>
                        </ul>
                    </li>';

                    }

                    if($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE"){
                        $retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado" || $_GET["ruta"] == "crear-prospecto")) ? "menu-is-opening menu-open" : "" ;

                        $retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado" || $_GET["ruta"] == "crear-prospecto")) ? "active" : "" ;

                        $retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "prospecto-asignado") ? "active" : "" ;
                        $retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "crear-prospecto" ) ? "active" : "" ;

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
                                <a href="prospecto-asignado" class="nav-link '.$retVal1.'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Prospectos Asignados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="crear-prospecto" class="nav-link '.$retVal2.'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear Prospecto</p>
                                </a>
                            </li>
                        </ul>
                    </li>';

                    }elseif ($_SESSION["S_ROL"] == "VENDEDOR") {
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
                    }

                    if($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE"){

                        $retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual" || $_GET["ruta"] == "clientes-vehiculo-individual")) ? "menu-is-opening menu-open" : "" ;

                        $retMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes-asistencia-medica-individual")) ? "menu-is-opening menu-open" : "" ;
                        $retMenu2= (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes-vehiculo-individual")) ? "menu-is-opening menu-open" : "" ;

                        $retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual" || $_GET["ruta"] == "clientes-vehiculo-individual")) ? "active" : "" ;

                        $retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes") ? "active" : "" ;

                        $retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes-asistencia-medica-individual") ? "active" : "" ;

                        $retVal3 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes-vehiculo-individual") ? "active" : "" ;



                        echo '<li class="nav-item '.$retMenu.'">
                        <a href="" class="nav-link '.$retVal.'">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                            Servicio al cliente
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asistencia Medica<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-asistencia-medica-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="reembolsos-asistencia-medica-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reembolsos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="operatorios-asistencia-medica-individual" class="nav-link '.$retVal1.'">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crédito Hospitalario</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="credito-ambulatorio-asistencia-medica-individual" class="nav-link '.$retVal1.'">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crédito Ambulatoria</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item '.$retMenu2.'">
                                <a href="" class="nav-link '.$retVal3.'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Vehiculos<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-vehiculo-individual" class="nav-link '.$retVal3.'">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Emisiones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a href="" class="nav-link">
                                    <i class="fas fa-th nav-icon"></i>
                                    <p>Cartera<i class="fas fa-angle-left right"></i></p>
                                </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="clientes" class="nav-link '.$retVal1.'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                        </ul>
                    </li>';

                    }

                    if($_SESSION["S_ROL"] == "CLIENTE"){

                        $retMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-asistencia-medica-individual" ||$_GET["ruta"] == "documento-asistencia-medica-individual" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente")) ? "menu-is-opening menu-open" : "" ;

                        $retMenu1_1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-asistencia-medica-individual" || $_GET["ruta"] == "documento-asistencia-medica-individual" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente")) ? "active" : "" ;

                        
                        $retVal1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-asistencia-medica-individual")) ? "active" : "" ;

                        $retSubMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "documento-asistencia-medica-individual" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente")) ? "menu-is-opening menu-open" : "" ;

                        $retSubMenu1_1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "documento-asistencia-medica-individual" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente")) ? "active" : "" ;

                        $retVal1_1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "documento-asistencia-medica-individual")) ? "active" : "" ;

                        $retVal1_2 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente")) ? "active" : "" ;

                        $retVal1_3 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente")) ? "active" : "" ;

                        $retMenu2= (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-vehiculo-individual")) ? "menu-is-opening menu-open" : "" ;

                        $retMenu2_1= (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-vehiculo-individual")) ? "active" : "" ;

                        $retVal2 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-vehiculo-individual")) ? "active" : "" ;

                        echo '<li class="nav-item '.$retMenu1.'">
                                    <a href="" class="nav-link '.$retMenu1_1.'">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>
                                        Asistencia Medica
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="contrato-asistencia-medica-individual" class="nav-link '.$retVal1.'">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Contratos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item '.$retSubMenu1.'">
                                            <a href="" class="nav-link '.$retSubMenu1_1.'">
                                                <i class="nav-icon fas fa-th"></i>
                                                <p>
                                                Servicio al cliente
                                                    <i class="fas fa-angle-left right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="documento-asistencia-medica-individual" class="nav-link '.$retVal1_1.'">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Formularios</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="reembolsos-asistencia-medica-individual-cliente" class="nav-link '.$retVal1_2.'">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Reembolsos</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="operatorios-asistencia-medica-individual-cliente" class="nav-link '.$retVal1_3.'">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Crédito Hospitalario</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="credito-ambulatorio-asistencia-medica-individual-cliente" class="nav-link '.$retVal1_3.'">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Crédito Ambulatoria</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>';
                            echo '<li class="nav-item '.$retMenu2.'">
                                <a href="" class="nav-link '.$retMenu2_1.'">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                    Vehiculos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-vehiculo-individual" class="nav-link '.$retVal2.'">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                            Servicio al cliente
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Formularios</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>';
                    }
                    
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
    
    
                        if($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE"){
                            $retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado-empresarial" || $_GET["ruta"] == "crear-prospecto-empresarial")) ? "menu-is-opening menu-open" : "" ;
    
                            $retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado-empresarial" || $_GET["ruta"] == "crear-prospecto-empresarial")) ? "active" : "" ;
    
                            $retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "prospecto-asignado-empresarial") ? "active" : "" ;
                            $retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "crear-prospecto-empresarial" ) ? "active" : "" ;
    
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
                                    <a href="prospecto-asignado-empresarial" class="nav-link '.$retVal1.'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Prospectos Asignados</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-prospecto-empresarial" class="nav-link '.$retVal2.'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Prospecto</p>
                                    </a>
                                </li>
                            </ul>
                        </li>';
    
                        }elseif ($_SESSION["S_ROL"] == "VENDEDOR") {
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
                        }
    
                        if($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE"){
    
                            $retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial")) ? "menu-is-opening menu-open" : "" ;
    
                            $retMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial")) ? "menu-is-opening menu-open" : "" ;
                            
                            $retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial")) ? "active" : "" ;
    
                            $retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes") ? "active" : "" ;
    
                            $retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial") ? "active" : "" ;
    
    
    
                            echo '<li class="nav-item '.$retMenu.'">
                            <a href="" class="nav-link '.$retVal.'">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                Servicio al cliente
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asistencia Medica<i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Emisiones</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="reembolsos-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Reembolsos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="operatorios-asistencia-medica-individual-empresarial" class="nav-link '.$retVal1.'">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crédito Hospitalario</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>';
    
                        }
    
                        if($_SESSION["S_ROL"] == "CLIENTE"){
    
                            $retMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-asistencia-medica-individual-empresarial" ||$_GET["ruta"] == "documento-asistencia-medica-individual-empresarial" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente-empresarial" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente-empresarial")) ? "menu-is-opening menu-open" : "" ;
    
                            $retMenu1_1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-asistencia-medica-individual-empresarial" || $_GET["ruta"] == "documento-asistencia-medica-individual-empresarial" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente-empresarial" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente-empresarial")) ? "active" : "" ;
    
                            
                            $retVal1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "contrato-asistencia-medica-individual-empresarial")) ? "active" : "" ;
    
                            $retSubMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "documento-asistencia-medica-individual-empresarial" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente-empresarial" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente-empresarial")) ? "menu-is-opening menu-open" : "" ;
    
                            $retSubMenu1_1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "documento-asistencia-medica-individual-empresarial" || $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente-empresarial" || $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente-empresarial")) ? "active" : "" ;
    
                            $retVal1_1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "documento-asistencia-medica-individual-empresarial")) ? "active" : "" ;
    
                            $retVal1_2 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente-empresarial")) ? "active" : "" ;
    
                            $retVal1_3 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente-empresarial")) ? "active" : "" ;
    
                            echo '<li class="nav-item '.$retMenu1.'">
                                        <a href="" class="nav-link '.$retMenu1_1.'">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                            Asistencia Medica
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="contrato-asistencia-medica-individual-empresarial" class="nav-link '.$retVal1.'">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Contratos</p>
                                                </a>
                                            </li>
                                            <li class="nav-item '.$retSubMenu1.'">
                                                <a href="" class="nav-link '.$retSubMenu1_1.'">
                                                    <i class="nav-icon fas fa-th"></i>
                                                    <p>
                                                    Servicio al cliente
                                                        <i class="fas fa-angle-left right"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="nav-item">
                                                        <a href="documento-asistencia-medica-individual-empresarial" class="nav-link '.$retVal1_1.'">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Formularios</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="reembolsos-asistencia-medica-individual-cliente-empresarial" class="nav-link '.$retVal1_2.'">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Reembolsos</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="operatorios-asistencia-medica-individual-cliente-empresarial" class="nav-link '.$retVal1_3.'">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Crédito Hospitalario</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>';
                        }
                        
                        echo '</ul>
                        </li>';
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
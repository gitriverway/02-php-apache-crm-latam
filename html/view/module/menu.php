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
                    } else {
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
                switch ($_SESSION["S_ROL"]) {
                    case 'ADMINISTRADOR':
                        include "menu-administrador.php";
                        break;
                    case 'GERENTE':
                        include "menu-gerencia.php";
                        break;
                    case 'GERENTE 1':
                        include "menu-gerencia-1.php";
                        break;
                    case 'SERVICIO CLIENTE':
                        include "menu-servicio-cliente.php";
                        break;
                    case 'VENDEDOR':
                        include "menu-vendedor.php";
                        break;
                    case 'CLIENTE':
                        include "menu-cliente.php";
                        break;
                    default:
                        # code...
                        break;
                }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
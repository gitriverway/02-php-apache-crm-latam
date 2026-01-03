<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav mr-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" id="menuNotificacionesProspectosIndividual">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosAltoIndividual">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosMedioIndividual">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosBajoIndividual">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosPymes">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosAltoPymes">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosMedioPymes">
        </li>
        <li class="nav-item dropdown" id="menuNotificacionesProspectosBajoPymes">
        </li>
        <?php
        if ($_SESSION["S_ROL"] == "ADMINISTRADOR" || $_SESSION["S_ROL"] == "GERENTE" || $_SESSION["S_ROL"] == "CLIENTE" || $_SESSION['S_ROL'] == "SERVICIO CLIENTE") {
        ?>

            <li class="nav-item dropdown" id="menuNotificacionesClientesIndividual">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesClientesPymes">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones" id="menuNotificacionesRenovasionesVidaIndividual">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones" id="menuNotificacionesRenovasionesVidaColectiva">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesAsistenciaMedica">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesVehiculoIndividual">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones" id="menuNotificacionesRenovasionesHogarIndividual">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesAsistenciaMedicaPymes">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesAccidentesPersonales">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesAccidentesPersonalesPymes">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesResponsabilidadCivil">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones"
                id="menuNotificacionesRenovasionesResponsabilidadCivilPymes">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones" id="menuNotificacionesRenovasionesIncendioPymes">
            </li>
            <li class="nav-item dropdown menuNotificacionesRenovasiones" id="menuNotificacionesRenovasionesTransportePymes">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesReembolsosAsistenciaMedica">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesReembolsosAsistenciaMedicaPymes">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesCreditosHospitalariosAsistenciaMedica">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesCreditosHospitalariosAsistenciaMedicaPymes">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesCreditosAmbulatoriosAsistenciaMedica">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesCreditosAmbulatoriosAsistenciaMedicaPymes">
            </li>
            <li class="nav-item dropdown" id="menuNotificacionesSiniestrosVehiculo">
            </li>
        <?php
        }
        ?>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Language Selector -->
        <?php
        require_once __DIR__ . '/../../model/modelo_idioma.php';
        $currentLang = Modelo_Idioma::getCurrentLanguage();
        ?>
        <li class="nav-item">
            <select id="selector_idioma" class="form-control form-control-sm" style="margin-top: 5px; width: auto; display: inline-block;">
                <option value="en" <?php echo $currentLang == 'en' ? 'selected' : ''; ?>>🇺🇸 English</option>
                <option value="es" <?php echo $currentLang == 'es' ? 'selected' : ''; ?>>🇪🇸 Español</option>
                <option value="pt-BR" <?php echo $currentLang == 'pt-BR' ? 'selected' : ''; ?>>🇧🇷 Português</option>
            </select>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="view/dist/img/avatar5.png" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">
                    <?php
                    if ($_SESSION['S_EMPLEADO'] == null) {
                        echo $_SESSION['S_USER'];
                    } else {
                        echo $_SESSION['S_EMPLEADO'];
                    }
                    ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="view/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    <p>
                        <?php
                        if ($_SESSION['S_EMPLEADO'] == null) {
                            echo $_SESSION['S_USER'] . ' - ' . $_SESSION['S_ROL'];
                        } else {
                            echo $_SESSION['S_EMPLEADO'] . ' - ' . $_SESSION['S_ROL'];
                        }
                        ?>
                    </p>
                </li>
                <!-- Menu Footer-->
                <?php
                require_once __DIR__ . '/../../model/modelo_idioma.php';
                $t = function($key) {
                    return Modelo_Idioma::t($key);
                };
                ?>
                <li class="user-footer">
                    <a href="perfil" class="btn btn-default btn-flat"><b><?php echo $t('common.profile'); ?></b></a>
                    <a href="salir" class="btn btn-default btn-flat float-right"><b><?php echo $t('common.close_session'); ?></b></a>
                </li>
            </ul>
        </li>

        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                
                <i class="fas fa-caret-down d-none d-sm-inline-block"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="salir" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span class="text-muted text-sm"><b>Cerrar Sesi&oacute;n</b></span>
                </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->
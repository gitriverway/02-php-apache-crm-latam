<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};
?>
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
            <?php echo $t('common.dashboard'); ?>
        </p>
    </a>
</li>
<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

$retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "usuarios") ? "active" : "";

$retMenu = (isset($_GET["ruta"]) && $_GET["ruta"] == "asignacion-prospecto") ? "menu-is-opening menu-open" : "";
$retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "asignacion-prospecto") ? "active" : "";
$retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "bloqueo-ip") ? "active" : "";

$retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "empleados") ? "active" : "";

$retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado" || $_GET["ruta"] == "crear-prospecto")) ? "menu-is-opening menu-open" : "";

$retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado" || $_GET["ruta"] == "crear-prospecto")) ? "active" : "";

$retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "prospecto-asignado") ? "active" : "";
$retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "crear-prospecto") ? "active" : "";
$retVal = (isset($_GET["ruta"]) && $_GET["ruta"] == "proveedores") ? "active" : "";

echo '<li class="nav-item">
                        <a href="usuarios" class="nav-link ' . $retVal . '">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                ' . $t('messages.manage_users') . '
                            </p>
                        </a>
                    </li>';


echo '<li class="nav-item">
                        <a href="bloqueo-ip" class="nav-link ' . $retVal . ' ">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                ' . $t('messages.ip_blocking_list') . '
                            </p>
                        </a>
                    </li>';

echo '<li class="nav-item">
                    <a href="empleados" class="nav-link ' . $retVal . '">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            ' . $t('messages.employees') . '
                        </p>
                    </a>
                </li>';

echo '<li class="nav-item">
                        <a href="proveedores" class="nav-link ' . $retVal . '">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                ' . $t('messages.providers') . '
                            </p>
                        </a>
                    </li>';

echo '<li class="nav-item">
                    <a href="" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
<p>
                                ' . $t('common.single') . '
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">';

echo '<li class="nav-item ' . $retMenu . '">
                        <a href="" class="nav-link ' . $retVal . '">
                            <i class="nav-icon fas fa-th"></i>
<p>
                            ' . $t('messages.marketing') . '
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="asignacion-prospecto" class="nav-link ' . $retVal . '">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('messages.web_assignment') . '</p>
                                </a>
                            </li>
                        </ul>
                    </li>';



echo '<li class="nav-item ' . $retMenu . '">
                        <a href="" class="nav-link ' . $retVal . '">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                            Ventas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="prospecto-asignado" class="nav-link ' . $retVal1 . '">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Prospectos Asignados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="crear-prospecto" class="nav-link ' . $retVal2 . '">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear Prospecto</p>
                                </a>
                            </li>
                        </ul>
                    </li>';


$retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual" || $_GET["ruta"] == "clientes-vehiculo-individual")) ? "menu-is-opening menu-open" : "";

$retMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes-asistencia-medica-individual")) ? "menu-is-opening menu-open" : "";
$retMenu2 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes-vehiculo-individual")) ? "menu-is-opening menu-open" : "";

$retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual" || $_GET["ruta"] == "clientes-vehiculo-individual")) ? "active" : "";

$retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes") ? "active" : "";

$retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes-asistencia-medica-individual") ? "active" : "";

$retVal3 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes-vehiculo-individual") ? "active" : "";



echo '<li class="nav-item ' . $retMenu . '">
                        <a href="" class="nav-link ' . $retVal . '">
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
<p>' . $t('messages.reimbursements_menu') . '</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="operatorios-asistencia-medica-individual" class="nav-link ' . $retVal1 . '">
                                            <i class="far fa-circle nav-icon"></i>
<p>' . $t('messages.hospital_credit_menu') . '</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="credito-ambulatorio-asistencia-medica-individual" class="nav-link ' . $retVal1 . '">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('messages.outpatient_credit_menu') . '</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item ' . $retMenu2 . '">
                                <a href="" class="nav-link ' . $retVal3 . '">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('messages.vehicles_menu') . '<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="clientes-vehiculo-individual" class="nav-link ' . $retVal3 . '">
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
                                    <p>' . $t('messages.portfolio') . '<i class="fas fa-angle-left right"></i></p>
                                </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="clientes" class="nav-link ' . $retVal1 . '">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('messages.clients') . '</p>
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
                                    ' . $t('common.pymes') . '
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">';


$retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado-empresarial" || $_GET["ruta"] == "crear-prospecto-empresarial")) ? "menu-is-opening menu-open" : "";

$retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "prospecto-asignado-empresarial" || $_GET["ruta"] == "crear-prospecto-empresarial")) ? "active" : "";

$retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "prospecto-asignado-empresarial") ? "active" : "";
$retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "crear-prospecto-empresarial") ? "active" : "";

echo '<li class="nav-item ' . $retMenu . '">
                            <a href="" class="nav-link ' . $retVal . '">
                                <i class="nav-icon fas fa-th"></i>
                            <p>
                                ' . $t('messages.sales') . '
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prospecto-asignado-empresarial" class="nav-link ' . $retVal1 . '">
                                        <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('messages.assigned_prospects') . '</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-prospecto-empresarial" class="nav-link ' . $retVal2 . '">
                                        <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('messages.create_prospect') . '</p>
                                    </a>
                                </li>
                            </ul>
                        </li>';

$retMenu = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial")) ? "menu-is-opening menu-open" : "";

$retMenu1 = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial")) ? "menu-is-opening menu-open" : "";

$retVal = (isset($_GET["ruta"]) && ($_GET["ruta"] == "clientes" || $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial")) ? "active" : "";

$retVal1 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes") ? "active" : "";

$retVal2 = (isset($_GET["ruta"]) && $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial") ? "active" : "";



echo '<li class="nav-item ' . $retMenu . '">
                            <a href="" class="nav-link ' . $retVal . '">
                                <i class="nav-icon fas fa-th"></i>
<p>
                            ' . $t('messages.customer_service') . '
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                    <p>' . $t('messages.medical_assistance_menu') . '<i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="clientes-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('messages.issuances_menu') . '</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="reembolsos-asistencia-medica-individual-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('messages.reimbursements_menu') . '</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="operatorios-asistencia-medica-individual-empresarial" class="nav-link ' . $retVal1 . '">
                                                <i class="far fa-circle nav-icon"></i>
                                            <p>' . $t('messages.hospital_credit_menu') . '</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="creditos-ambulatorios-asistencia-medica-individual-empresarial" class="nav-link ' . $retVal1 . '">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crédito Ambulatorio</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>';

echo '</ul>
                        </li>';
?>
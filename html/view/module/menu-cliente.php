<?php

$tipo_cliente = 0;
$tipo_empresarial = 0;

$vida_individual = 0;
$vida_empresarial = 0;
$asistencia_medica_individual = 0;
$vehiculo_individual = 0;
$asistencia_medica_empresarial = 0;
$accidentes_personales = 0;
$accidentes_personales_empresarial = 0;
$hogar_individual = 0;

$CM = new Listar_clientes();

$consulta = $CM->mostrar_contar_lista_clientes();

for ($i = 0; $i < count($consulta); $i++) {
    switch ($consulta[$i]["categoria_tipo"]) {
        case 'I':
            $tipo_cliente++;
            break;
        case 'E':
            $tipo_empresarial++;
            break;
        default:
            # code...
            break;
    }
    switch ($consulta[$i]["categoria_id"]) {
        case '1':
            $vida_individual++;
            break;
        case '2':
            $vida_empresarial++;
            break;
        case '3':
            $asistencia_medica_individual++;
            break;
        case '4':
            $vehiculo_individual++;
            break;
        case '5':
            $asistencia_medica_empresarial++;
            break;
        case '7':
            $accidentes_personales++;
            break;
        case '8':
            $accidentes_personales_empresarial++;
            break;
        case '9':
            $hogar_individual++;
            break;
        default:
            # code...
            break;
    }
}

?>

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

if ($tipo_cliente > 0) {

    if ($vida_individual > 0) {

        echo '<li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-heart"></i>
                                    <p>
                                    Vida Individual
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-vida-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>';
    }

    if ($asistencia_medica_individual > 0) {

        echo '<li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fa fa-medkit"></i>
                                        <p>
                                        Asistencia Medica
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="contrato-asistencia-medica-individual" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Contratos</p>
                                            </a>
                                        </li>
                                        
                                                <li class="nav-item">
                                                    <a href="documento-asistencia-medica-individual" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Formularios</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="reembolsos-asistencia-medica-individual-cliente" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Reembolsos</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="operatorios-asistencia-medica-individual-cliente" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Crédito Hospitalario</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="credito-ambulatorio-asistencia-medica-individual-cliente" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Crédito Ambulatoria</p>
                                                    </a>
                                                </li>
                                            
                                    </ul>
                                </li>';
    }

    if ($vehiculo_individual > 0) {

        echo '<li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-car"></i>
                                    <p>
                                    Vehiculos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-vehiculo-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                    
                                            <li class="nav-item">
                                                <a href="documento-vehiculo-individual" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Formularios</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="siniestros-vehiculo-individual-cliente" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Siniestros</p>
                                                </a>
                                            </li>
                                        
                                </ul>
                            </li>';
    }

    if ($accidentes_personales > 0) {
        echo '<li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-plus-square"></i>
                                    <p>
                                    Accidentes Personales
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-accidentes-personales-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>';
    }

    if ($hogar_individual > 0) {

        echo '<li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-home"></i>
                                    <p>
                                    Hogares
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-hogar-individual" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                    
                                            <li class="nav-item">
                                                <a href="documento-hogar-individual" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Formularios</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="siniestros-hogar-individual-cliente" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Siniestros</p>
                                                </a>
                                            </li>
                                        
                                </ul>
                            </li>';
    }

}


if ($tipo_empresarial > 0) {

    if ($vida_empresarial > 0) {
        echo '<li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-heart"></i>
                                    <p>
                                    Vida Individual
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-vida-individual-empresarial" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>';
    }

    if ($asistencia_medica_empresarial > 0) {

        echo '<li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon fa fa-medkit"></i>
                                            <p>
                                            Asistencia Medica
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="contrato-asistencia-medica-individual-empresarial" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Contratos</p>
                                                </a>
                                            </li>
                                                    <li class="nav-item">
                                                        <a href="documento-asistencia-medica-individual-empresarial" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Formularios</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="reembolsos-asistencia-medica-individual-cliente-empresarial" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Reembolsos</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="operatorios-asistencia-medica-individual-cliente-empresarial" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Crédito Hospitalario</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                            <a href="credito-ambulatorio-asistencia-medica-individual-cliente-empresarial" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crédito Ambulatorio</p>
                                            </a>
                                        </li>
                                                
                                        </ul>
                                    </li>';
    }


    if ($accidentes_personales_empresarial > 0) {
        echo '<li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fa fa-plus-square"></i>
                                    <p>
                                    Accidentes Personales
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="contrato-accidentes-personales-empresarial" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contratos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>';
    }
}
?>
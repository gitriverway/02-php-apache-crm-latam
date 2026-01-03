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

echo '
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
                            
                        </ul>
                        </li>

                        </ul>
                    </li>';
?>
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
$responsabilidad_civil = 0;
$incendios_pymes = 0;
$transporte_pymes = 0;

$CM = new Listar_clientes();

$consulta = $CM->mostrar_contar_lista_clientes();

// echo $_SESSION['S_IDUSUARIO'];
// echo json_encode($consulta);

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
        case '11':
            $responsabilidad_civil++;
            break;
        case '15':
            $incendios_pymes++;
            break;
        case '16':
            $transporte_pymes++;
            break;
        default:
            # code...
            break;
    }
}

?>

<?php


if ($vida_individual > 0) {

    include "cajas/cliente/caja-cliente-vida-individual.php";
}

if ($asistencia_medica_individual > 0) {
    include "cajas/cliente/caja-cliente-asistencia-medica-individual.php";
}

if ($vehiculo_individual > 0) {
    include "cajas/cliente/caja-cliente-vehiculo-individual.php";
}

if ($accidentes_personales > 0) {
    include "cajas/cliente/caja-cliente-accidentes-personales-individual.php";
}

if ($hogar_individual > 0) {
    include "cajas/cliente/caja-cliente-hogar-individual.php";
}

if ($vida_empresarial > 0) {
    include "cajas/cliente/caja-cliente-vida-pymes.php";
}

if ($asistencia_medica_empresarial > 0) {
    include "cajas/cliente/caja-cliente-asistencia-medica-pymes.php";
}

if ($accidentes_personales_empresarial > 0) {
    include "cajas/cliente/caja-cliente-accidentes-personales-pymes.php";
}

if ($responsabilidad_civil > 0) {
    include "cajas/cliente/caja-cliente-responsabilidad-civil.php";
}
if ($incendios_pymes > 0) {
    include "cajas/cliente/caja-cliente-incendios-pymes.php";
}
if ($transporte_pymes > 0) {
    include "cajas/cliente/caja-cliente-transporte-pymes.php";
}

?>

<script>
$(document).ready(function() {
    contadoresClientes();
})
</script>
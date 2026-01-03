<?php

	require '../../../controladores/salud/controlador_planes_listar_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_vumi_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_best_doctor_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_humana_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_bmi_nacional_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_bmi_internacional_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_bupa_salud_seleccionados.php';
	require '../../../controladores/salud/controlador_planes_listar_pali_salud_seleccionados.php';
	require '../../../modelos/modelo_prospecto_web.php';
    require '../../../modelos/modelo_producto.php';
	require '../../../modelos/modelo_zona_provincia_proveedor.php';
    require '../../../modelos/modelo_rango_salud.php';
	require '../../../modelos/modelo_cobertura_plus_vumi.php';


class imprimirFactura{
	
public $idCliente;
	
public function traerImpresionFactura(){

$count = 0;

$id = $this->idCliente;

$MU = new Lista_producto_salud_seleccionado();
$consulta = $MU->mostrar_lista_producto_salud_seleccionado($id);

$proveedor_logo[]="";
$proveedor_descripcion[]="";
$valorZona[]="";
$deducible_d1[]="";
$montoCobertura_d2[]="";
$carencias_d3[]="";
$periodo_carencia_d4[]="";
$coberturas_preexistencias_d5[]="";
$segunda_opinion_medica_d6[]="";
$coberturaHospitalaria_d7[]="";
$redHospitalaria_d8[]="";
$redHospitalariaMundial_d9[]="";
$transplante_d10[]="";
$cuidadosIntensivos_d11[]="";
$medicinaHospitalaria_d12[]="";
$cirugia_cancer_d13[]="";
$vih_d14[]="";
$cirugia_bariatica_d15[]="";
$coberturaAmbulatoria_d16[]="";
$medicinaAmbulatoria_d17[]="";
$fisioterapia_d18[]="";
$chequeo_medico_d19[]="";
$trastornos_d20[]="";
$alzheimer_d21[]="";
$maternidad_d22[]="";
$carencia_maternidad_d23[]="";
$complicaciones_recien_nacido_d24[]="";
$Condiciones_congenitas_d25[]="";
$fallecimiento_titular_d26[]="";
$cliente_nombre = "";
$plan_descripcion[]="";
$cliente_familiares="";
$producto_nombre[]="";
$provincia_descripcion="";

$cadenatd = "";

//echo $consulta;

$consulta = json_decode($consulta, true);

foreach ($consulta as $key => $value) {

	$valorZona[$key] = $value["valorZona"];
	$deducible_d1[$key] = $value["d1"];
	$montoCobertura_d2[$key] = $value["d2"];
	$carencias_d3[$key]=$value["d3"];
	$periodo_carencia_d4[$key]=$value["d4"];
	$coberturas_preexistencias_d5[$key]=$value["d5"];
	$segunda_opinion_medica_d6[$key]=$value["d6"];
	$coberturaHospitalaria_d7[$key] = $value["d7"];
	$redHospitalaria_d8[$key]=$value["d8"];
	$redHospitalariaMundial_d9[$key]=$value["d9"];
	$transplante_d10[$key] = $value["d10"];
	$cuidadosIntensivos_d11[$key] = $value["d11"];
	$medicinaHospitalaria_d12[$key]=$value["d12"];
	$cirugia_cancer_d13[$key]=$value["d13"];
	$vih_d14[$key]=$value["d14"];
	$cirugia_bariatica_d15[$key]=$value["d15"];
	$coberturaAmbulatoria_d16[$key]=$value["d16"];
	$medicinaAmbulatoria_d17[$key]=$value["d17"];
	$fisioterapia_d18[$key]=$value["d18"];
	$chequeo_medico_d19[$key]=$value["d19"];
	$trastornos_d20[$key]=$value["d20"];
	$alzheimer_d21[$key]=$value["d21"];
	$maternidad_d22[$key]=$value["d22"];
	$carencia_maternidad_d23[$key]=$value["d23"];
	$complicaciones_recien_nacido_d24[$key]=$value["d24"];
	$Condiciones_congenitas_d25[$key]=$value["d25"];
	$fallecimiento_titular_d26[$key]=$value["d26"];
	$proveedor_logo[$key]=$value["proveedor_logo"];
	$proveedor_descripcion[$key]=$value["proveedor_descripcion"];
	$cliente_nombre = $value["cliente_nombre"];
	$cliente_familiares = $value["cliente_familiares"];
	$plan_descripcion[$key]=$value["plan_descripcion"];
	$producto_nombre[$key]=$value["producto_nombre"];
	$provincia_descripcion = $value["provincia_descripcion"];
	
	$count++;
 }

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------
date_default_timezone_set("America/Bogota");

$fecha = date("d-m-Y");

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td><img style="width:120px; height:50px;" src="images/logo-mqp-azul-contenido.png">
			</td>

			<td style="background-color:white;">
				
				<div style="font-size:12px; line-height:15px;">

				<br>
					<strong>CUADRO COMPARADOR</strong>
				</div>

			</td>

			<td style="background-color:white;">

				<div style="font-size:12px; text-align:right; line-height:15px;">

					<br>
					RE-GC-004

				</div>
				
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$familiares = "";

foreach ($cliente_familiares as $value) {
	$familiares.="Edades: ".$value["edad"]." años<br>";
}

$familiares = substr($familiares, 0, -4);

$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="background-color:white;">
				Cliente: $cliente_nombre
			</td>

			<td style="background-color:white;">
				$familiares
			</td>
			</tr>
	</table>
	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>
	<table>
			<tr>
			<td style="background-color:white;">
				Provincia: $provincia_descripcion
			</td>

			<td style="background-color:white;">
				Fecha: $fecha
			</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$cadenatd = "";
// ---------------------------------------------------------

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">
	<img style="width:120px; height:50px;" src="../../../'.$proveedor_logo[$i].'" alt="logo-proveedor"></td>';
}

$bloque31 = <<<EOF

<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>
	
<table style="font-size:10px; padding:5px 10px;">
	<tr>
	<td style="border: 1px solid #666; background-color:white; text-align:center"></td>
		$cadenatd
	</tr>
</table>

EOF;

$pdf->writeHTML($bloque31, false, false, false, false, '');

$cadenatd = "";
// ---------------------------------------------------------

// LINEA DE PLANES DESCRIPCION

$cadenatd .='<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Plan</strong></td>';
for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>'.$plan_descripcion[$i].'</strong></td>';
}
$cadenatd .='</tr>';

// LINEA DE CUOTA MENSUAL

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cuota mensual</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">$'.$valorZona[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE DEDUCIBLE

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Deducible</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">$'.$deducible_d1[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE COBERTURA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cobertura máxima anual por afiliado</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$montoCobertura_d2[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE PERIODO DE CARENCIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Período de carencia</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$carencias_d3[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE PERIODO DE CARENCIA PREEXISTENTES

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Período de carencia enfermedades preexistentes</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$periodo_carencia_d4[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE COBERTURA ENFERMEDAD

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cobertura enfermedades preexistentes</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$coberturas_preexistencias_d5[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE SEGUNDA OPINION MEDICA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Segunda opinión médica</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$segunda_opinion_medica_d6[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE COBERTURA HOSPITALARIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cobertura Hospitalaria</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$coberturaHospitalaria_d7[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE COBERTURA HOSPITALARIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Libre elección mundial</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$redHospitalaria_d8[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE RED HOSPITALARIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Red hospitales</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$redHospitalariaMundial_d9[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE TRANSPLANTE DE ORGANOS

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Trasplante de órganos</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$transplante_d10[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE CUIDADOS INTENSIVOS

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cuidado Intensivos</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$cuidadosIntensivos_d11[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE MEDICINA HOSPITALARIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Medicina hospitalización</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$medicinaHospitalaria_d12[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE RIESGO CANCER

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cirugía reducción riesgo cáncer</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$cirugia_cancer_d13[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE VHI

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>VHI - Sida</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$vih_d14[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE CIRUGIA BARIATICA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cirugía por obesidad</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$cirugia_bariatica_d15[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE COBERTURA AMBULATORIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cobertura ambulatoria</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$coberturaAmbulatoria_d16[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE MEDICINA AMBULATORIA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Medicina ambulatoria</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$medicinaAmbulatoria_d17[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE TERAPIA DE REHABILITACION

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Terapias de rehabilitación</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$fisioterapia_d18[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE CHEQUEO MEDICO PREVENTIVO

// $cadenatd .= '<tr>';
// $cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Chequeo médico preventivo (tarifas cero)</strong></td>';

// for ($i=0; $i < $count; $i++) { 
	
// 	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$chequeo_medico_d19[$i].'</td>';
// }

// $cadenatd .= '</tr>';

// LINEA DE TRASTORNOS

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Psiquiatría, terapia ocupacional, terapia de lenguaje, autismo, apnea del sueño y otros trastornos del sueño.</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$trastornos_d20[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE ALZHEIMER

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Alzheimer</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$alzheimer_d21[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE MATERNIDAD

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Maternidad</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$maternidad_d22[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE CARENCIA DE MATERNIDAD

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Período carencia maternidad</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$carencia_maternidad_d23[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE COMPLICACIONES MATERNIDAD

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Complicaciones madre y recién nacido</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$complicaciones_recien_nacido_d24[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE CONDICIONES CONGENITAS

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Condiciones congénitas</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$Condiciones_congenitas_d25[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE FALLECIMIENTO TITULAR

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cobertura fallecimiento titular</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$fallecimiento_titular_d26[$i].'</td>';
}

$cadenatd .= '</tr>';


$bloque3 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">	
		$cadenatd
</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

$bloque4 = <<<EOF
<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>
<table style="font-size:10px; padding:5px 10px;">	
<tr>
	<td style="width:540px">* Esta cotización es referencial y temporal.</td>
</tr>
<tr>
	<td style="width:540px">* Las tarifas están sujetas a modificación, pueden variar de acuerdo a la vigencia y a la información proporcionada.</td>
</tr>
<tr>
	<td style="width:540px">* Toda la información que usted proporcione puede ser sujeta a verificación posterior por parte de las aseguradoras.</td>
</tr>
</table>
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO

$pdf->Output('planes.pdf', 'D');

}
}

/*=============================================
ACTIVAR TABLA DE PRODUCTO SALUD
=============================================*/
$factura = new imprimirFactura();
$factura -> idCliente = $_GET["idCliente"];
$factura -> traerImpresionFactura();
<?php

	require '../../../controladores/vehiculo/controlador_planes_listar_vehiculo_seleccionados.php';
	require '../../../controladores/vehiculo/controlador_planes_listar_latina_vehiculo_seleccionados.php';
	require '../../../controladores/vehiculo/controlador_planes_listar_vaz_vehiculo_seleccionados.php';
	require '../../../controladores/vehiculo/controlador_planes_listar_zurich_vehiculo_seleccionados.php';
	require '../../../controladores/vehiculo/controlador_planes_listar_aig_vehiculo_seleccionados.php';
	require '../../../modelos/modelo_prospecto_web.php';
    require '../../../modelos/modelo_producto.php';

class imprimirFactura{
	
public $idCliente;
	
public function traerImpresionFactura(){

$count = 0;

$id = $this->idCliente;

$MU = new Lista_producto_vehiculo_seleccionado();
$consulta = $MU->mostrar_lista_producto_vehiculo_seleccionado($id);

$proveedor_logo[]="";
$proveedor_descripcion[]="";
$total[]="";
$tasa_d1[]="";
$forma_pago_d2[]="";
$todo_riesgo_d3[]="";
$perdida_total_robo_d4[]="";
$perdida_total_otros_d5[]="";
$perdida_parcial_d6[]="";
$responsabilidad_civil_d7[]="";
$accidentes_personales_d8[]="";
$gastos_medicos_d9[]="";
$amparo_patrimonial_d10[]="";
$auto_sustituto_d11[]="";
$red_talleres_d12[]="";
$pacto_andino_d13[]="";
$asistencia_legal_d14[]="";
$cliente_nombre = "";
$plan_descripcion[]="";
$cliente_vehiculos="";
$producto_nombre[]="";
$provincia_descripcion="";

$cadenatd = "";

//echo $consulta;

$consulta = json_decode($consulta, true);

foreach ($consulta as $key => $value) {

	$total[$key] = $value["total"];
	$tasa_d1[$key] = $value["d1"];
	$forma_pago_d2[$key] = $value["d2"];
	$todo_riesgo_d3[$key]=$value["d3"];
	$perdida_total_robo_d4[$key]=$value["d4"];
	$perdida_total_otros_d5[$key]=$value["d5"];
	$perdida_parcial_d6[$key]=$value["d6"];
	$responsabilidad_civil_d7[$key] = $value["d7"];
	$accidentes_personales_d8[$key]=$value["d8"];
	$gastos_medicos_d9[$key]=$value["d9"];
	$amparo_patrimonial_d10[$key] = $value["d10"];
	$auto_sustituto_d11[$key] = $value["d11"];
	$red_talleres_d12[$key]=$value["d12"];
	$pacto_andino_d13[$key]=$value["d13"];
	$asistencia_legal_d14[$key]=$value["d14"];
	$proveedor_logo[$key]=$value["proveedor_logo"];
	$proveedor_descripcion[$key]=$value["proveedor_descripcion"];
	$cliente_nombre = $value["cliente_nombre"];
	$cliente_vehiculos = $value["cliente_vehiculos"];
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

$tipo = "";
$marca = "";
$modelo = "";
$ano = "";
$monto = "";

foreach ($cliente_vehiculos as $value) {
	$tipo="Tipo: ".$value["tipo"];
	$marca="Modelo: ".$value["modelo"];
	$modelo="Marca: ".$value["marca"];
	$ano="Año: ".$value["ano"];
	$monto="Monto: $".floatval($value["monto"]);
}

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
				$tipo
			</td>
			<td style="background-color:white;">
				$marca
			</td>
			<td style="background-color:white;">
				$modelo
			</td>
			<td style="background-color:white;">
				$ano
			</td>
			<td style="background-color:white;">
				$monto
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
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">$'.$total[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE TASA

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Tasa</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$tasa_d1[$i].'%</td>';
}

$cadenatd .= '</tr>';

// LINEA DE FORMA DE PAGO

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Forma de Pago</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$forma_pago_d2[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE TODO RIESGO

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Todo Riesgo</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$todo_riesgo_d3[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE DEDUCIBLE PERDIDA TOTAL ROBO

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Deducibles pérdida total robo</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$perdida_total_robo_d4[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE DEDUCIBLE PERDIDA TOTAL OTROS

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Deducibles pérdida total por otro evento</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$perdida_total_otros_d5[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE DEDUCIBLE PERDIDA PARCIAL

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Deducibles pérdida parcial</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$perdida_parcial_d6[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE RESPONSABILIDAD CIVIL

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Responsabilidad civil</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$responsabilidad_civil_d7[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE ACCIDENTES PERSONALES

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Accidentes personales</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$accidentes_personales_d8[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE GASTOS MEDICOS

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Gastos médicos</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$gastos_medicos_d9[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE AMPARO PATRIMONIAL

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Amparo patrimonial</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$amparo_patrimonial_d10[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE AUTO SUSTITUTO

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Auto sustituto</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$auto_sustituto_d11[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE RED DE TALLERES

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Red de talleres</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$red_talleres_d12[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE PACTO ANDINO

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Cobertura Pacto Andino</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$pacto_andino_d13[$i].'</td>';
}

$cadenatd .= '</tr>';

// LINEA DE ASISTENCIA LEGAL

$cadenatd .= '<tr>';
$cadenatd .= '<td style="border: 1px solid #666; background-color:white; text-align:center"><strong>Asistencia Legal</strong></td>';

for ($i=0; $i < $count; $i++) { 
	
	$cadenatd.='<td style="border: 1px solid #666; background-color:white; text-align:center">'.$asistencia_legal_d14[$i].'</td>';
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
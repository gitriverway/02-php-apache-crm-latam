<?php

require '../../model/modelo_reporte.php';

class ReporteRespaldosBayerPersona
{

    /*=============================================
	DESCARGAR EXCEL
	=============================================*/

    public function DescargarReporteRespaldosBayerPersona()
    {


        $MC = new Modelo_Reporte();
        $descargarBayerPersona = $MC->descargar_bayer_persona();

        date_default_timezone_set("America/Guayaquil");
        $fecha = date('Y-m-d');
        $hora = date('H-i-s');
        $fechaActual = $fecha . '-' . $hora;


        /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $Name = 'RespaldosBayerPersona-'.$fechaActual.'.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.ms-excel; charset=utf-8"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $Name . '"');
        header("Content-Transfer-Encoding: binary");

        

        $dato = null;
        $dato1 = null;

        for ($i = 0; $i < count($descargarBayerPersona); $i++) {

            $dato .= "<tr style='border:1px solid #eee;'>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_id"]."</td> 
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_ci"]."</td> 
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_nombre"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_fecha_nacimiento"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_genero"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_email"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_email_opcional"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_telefono"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_telefono_opcional"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_direccion"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_ocupacion"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_origen"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_ingreso"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["provincia_descripcion"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["ciudad_id"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["bayer_id"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_tipo"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_estado_bayer"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_valor_asegurado"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_prima_neta"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_prima_comisionable"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_prima_total"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_tipo_pago"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_forma_pago"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_fecha_seguimiento"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["categoria_nombre"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["proveedor_descripcion"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["producto_id"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["empleado_nombre"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["bayer_dependiente_id"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_familiares"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_vehiculos"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_chat"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["cliente_condiciones"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["contrato_id"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["contrato_numero"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["contrato_fecha_inicio"]."</td>
                        <td style='border:1px solid #eee;'>".$descargarBayerPersona[$i]["contrato_fecha_fin"]."</td>
                    <tr>";

        }

        $dato1="<tr style='border:1px solid #eee;'> 
                <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE ID</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CEDULA</td> 
                <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
                <td style='font-weight:bold; border:1px solid #eee;'>FECHA NACIMIENTO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>GENERO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CORREO ELECTRONICO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CORREO ELECTRONICO ALTERNO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>TELEFONO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>TELEFONO ALTERNO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>DIRECCIÓN</td>
                <td style='font-weight:bold; border:1px solid #eee;'>OCUPACIÓN</td>
                <td style='font-weight:bold; border:1px solid #eee;'>ORIGEN</td>
                <td style='font-weight:bold; border:1px solid #eee;'>VALOR DE INGRESOS</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PROVINCIA</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CIUDAD</td>
                <td style='font-weight:bold; border:1px solid #eee;'>BAYER PERSONA ID</td>
                <td style='font-weight:bold; border:1px solid #eee;'>TIPO DE CLIENTE</td>
                <td style='font-weight:bold; border:1px solid #eee;'>ESTADO DEL BAYER PERSONA</td>
                <td style='font-weight:bold; border:1px solid #eee;'>VALOR ASEGURADO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRIMA NETA</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRIMA COMISIONABLE</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRIMA TOTAL</td>
                <td style='font-weight:bold; border:1px solid #eee;'>FRECUENCIA DE PAGO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>FORMA DE PAGO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE SEGUIMIENTO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>RAMO ASIGNADO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
                <td style='font-weight:bold; border:1px solid #eee;'>BAYER DEPENDIENTE ID</td>
                <td style='font-weight:bold; border:1px solid #eee;'>LISTA DEPENDIENTES</td>
                <td style='font-weight:bold; border:1px solid #eee;'>LISTA VEHICULOS</td>
                <td style='font-weight:bold; border:1px solid #eee;'>LISTA CHAT</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CONDICIONES RENOVACIÓN</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CONTRATO ID</td>
                <td style='font-weight:bold; border:1px solid #eee;'>NUMERO DE CONTRATO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>INICIO DE CONTRATO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>FIN DE CONTRATO</td>
                </tr>"
                .$dato;

        echo utf8_decode("<table border='0'> 

        <tr> 
            <td style='font-weight:bold; border:1px solid #eee;'>RESPLADO BAYER PERSONA 2023</td> 
        </tr>".$dato1."
        </table>");
        

        // 	echo utf8_decode("</td>
        // 		<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
        // 		<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
        // 		<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
        // 		<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
        // 		<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
        // 		</tr>");

    }
}

$reporte = new ReporteRespaldosBayerPersona();
$reporte->DescargarReporteRespaldosBayerPersona();

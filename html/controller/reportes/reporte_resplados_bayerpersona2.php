<?php

require '../../view/vendor/autoload.php';
require '../../model/modelo_reporte.php';

class ReporteRespaldosBayerPersona
{

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;
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

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setTitle("Respaldos");
        $activeWorksheet->setCellValue('A1', 'Hello World !');

        $fila = 2;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}

$reporte = new ReporteRespaldosBayerPersona();
$reporte->DescargarReporteRespaldosBayerPersona();

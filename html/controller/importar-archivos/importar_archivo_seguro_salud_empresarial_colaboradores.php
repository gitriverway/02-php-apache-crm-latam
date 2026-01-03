<?php

class Importar_Archivo_Seguro_salud_Empresarial_Colaboradores
{
    function archivo_seguros_salud_empresarial_colaboradores()
    {
        $datosJson = '[]';

        if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['csv_file']['tmp_name'];

            // Leer el archivo CSV
            if (($handle = fopen($fileTmpPath, 'r')) !== FALSE) {

                // Saltar las primeras 4 filas (encabezado + filas irrelevantes)
                for ($i = 0; $i < 1; $i++) {
                    fgetcsv($handle, 1000, ";");
                }

                // Contador de filas procesadas
                $rowCount = 0;

                $datosJson = "[";

                // Leer las filas a partir de la fila 10
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    // Verificar que la fila tenga al menos 3 columnas
                    if (count($data) >= 4  && !empty($data[1])) {
                        $datosJson .= "{";
                        $edad = 0;
                        $lista_dependientes = '[]';

                        $datosJson .= '"tipo":"' . htmlspecialchars($data[1]) . '",';
                        $datosJson .= '"nombre":"' . htmlspecialchars($data[2]) . '",';
                        $datosJson .= '"genero":"' . htmlspecialchars($data[3]) . '",';
                        $datosJson .= '"fecha_nacimiento":"' . htmlspecialchars($data[4]) . '",';
                        $datosJson .= '"edad":"' . $edad . '",';
                        $datosJson .= '"valor_deducible":"' . htmlspecialchars($data[5]) . '",';
                        $datosJson .= '"lista_dependientes":' . $lista_dependientes . '';
                        $datosJson .= "},";
                    }

                    // Incrementar el contador de filas
                    $rowCount++;

                    // Si ya se han procesado 200 filas, detener el bucle
                    if ($rowCount >= 200) {
                        break;
                    }
                }

                $datosJson = substr($datosJson, 0, -1);

                $datosJson .= ']';

                echo $datosJson;

                fclose($handle);
            } else {
                echo $datosJson;
            }
        } else {
            echo $datosJson;
        }
    }
}



/*=============================================
IMPORTAR ARCHIVO
=============================================*/
$importar_archivo = new Importar_Archivo_Seguro_salud_Empresarial_Colaboradores();
$importar_archivo->archivo_seguros_salud_empresarial_colaboradores();

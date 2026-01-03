<?php
    require_once 'modelo_conexion.php';

    class Modelo_Credito_Ambulatorio_Cliente_Documento  extends conexionBD{

        /***********************************
         *******CREAR NUEVO REGRISTRO DOCUMENTO CREDITO AMBULATORIO CLIENTE
        ***********************************/
        function Registrar_credito_ambulatorio_cliente_documento($idCreditoAmbulatorio,$nombreArchivo,$rutaArchivo,$fechaActual){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_CREAR_CREDITO_AMBULATORIO_CLIENTE_DOCUMENTO(:idCreditoAmbulatorio,:nombre_documento,:ruta_documento,:fechaActual)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
            $stmt->bindParam(':nombre_documento', $nombreArchivo, PDO::PARAM_STR);
            $stmt->bindParam(':ruta_documento', $rutaArchivo, PDO::PARAM_STR);
            $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            $arreglo = array();

                foreach ($respuesta as $value) {

                    $arreglo[] = $value;

                }
            return $arreglo;

            conexionBD::cerrar_conexion();

        }
    }
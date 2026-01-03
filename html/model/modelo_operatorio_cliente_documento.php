<?php
    require_once 'modelo_conexion.php';

    class Modelo_Operatorio_Cliente_Documento  extends conexionBD{

        /***********************************
         *******CREAR NUEVO REGRISTRO DOCUMENTO OPERATORIO CLIENTE
        ***********************************/
        function Registrar_operatorio_cliente_documento($idOperatorio,$nombreArchivo,$rutaArchivo,$fechaActual){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_CREAR_OPERATORIO_CLIENTE_DOCUMENTO(:idOperatorio,:nombre_documento,:ruta_documento,:fechaActual)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
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
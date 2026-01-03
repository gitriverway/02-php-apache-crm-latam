<?php
    require_once 'modelo_conexion.php';

    class Modelo_Reembolso_Cliente_Documento  extends conexionBD{

        /***********************************
         *******CONSULTAR LISTA DE FACTURAS de CLIENTES
        ***********************************/

        function listar_reembolso_cliente_documento($idCliente){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_LISTAR_REEMBOLSOS_CLIENTES_DOCUMENTO(:idCliente)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CREAR NUEVO REGRISTRO CONTRATO CLIENTE
        ***********************************/
        function Registrar_reembolso_cliente_documento($idReembolso,$nombreArchivo,$rutaArchivo,$fechaActual){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_CREAR_REEMBOLSO_CLIENTE_DOCUMENTO(:idReembolso,:nombre_documento,:ruta_documento,:fechaActual)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
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
<?php
require_once 'modelo_conexion.php';

class Modelo_Contrato_Cliente_Documento  extends conexionBD
{

    /***********************************
     *******CONSULTAR LISTA DE FACTURAS de CLIENTES
     ***********************************/

    function listar_contrato_cliente_documento($idCliente)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CONTRATOS_CLIENTES_DOCUMENTO(:idCliente)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CREAR NUEVO REGRISTRO CONTRATO CLIENTE
     ***********************************/
    function Registrar_contrato_cliente_documento($idBayer, $nombreArchivo, $carpetaDocumento, $rutaArchivo, $fechaActual)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CREAR_CONTRATO_CLIENTE_DOCUMENTO(:cliente_id,:nombre_documento,:carpeta_documento,:ruta_documento,:fechaActual)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':cliente_id', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_documento', $nombreArchivo, PDO::PARAM_STR);
        $stmt->bindParam(':carpeta_documento', $carpetaDocumento, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_documento', $rutaArchivo, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        $arreglo = array();

        foreach ($respuesta as $value) {

            $arreglo[] = $value;
        }
        return $arreglo;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******ELIMINAR DOCUMENTO EMISION
     ***********************************/
    function Eliminar_Documento_Emision($idDocumentoEmision)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_ELIMINAR_DOCUMENTO_EMISION(:idDocumentoEmision)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idDocumentoEmision', $idDocumentoEmision, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }
}

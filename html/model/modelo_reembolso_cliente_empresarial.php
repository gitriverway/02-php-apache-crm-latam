<?php
require_once 'modelo_conexion.php';

class Modelo_Reembolso_Cliente_Empresarial  extends conexionBD
{

    /***********************************
     *******CONSULTAR LISTA DE REEMBOLSOS
     ***********************************/

    function listar_reembolso_asistencia_medica($idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_REEMBOLSOS_ASISTENCIA_MEDICA_PYMES(:categoria_id)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE REEMBOLSOS de CLIENTES
     ***********************************/

    function listar_reembolso_cliente_asistencia_medica($idCliente, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_REEMBOLSOS_CLIENTES_ASISTENCIA_MEDICA_PYMES(:cliente_id,:categoria_id)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':cliente_id', $idCliente, PDO::PARAM_STR);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CONTRATOS de CLIENTES
     ***********************************/

    function listar_reembolso_cliente_vida($idCliente, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_REEMBOLSOS_CLIENTES_VIDA_PYMES(:cliente_id,:categoria_id)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':cliente_id', $idCliente, PDO::PARAM_STR);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CONTRATOS de CLIENTES
     ***********************************/

    function traer_reembolso_unico($idReembolso, $idContrato)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_REEMBOLSOS_ASISTENCIA_MEDICA_IDREEMBOLSO_PYMES(:idReembolso, :idContrato)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CREAR NUEVO REGRISTRO REEMBOLSO CLIENTE
     ***********************************/
    function Registrar_Reembolso($idBayer, $idContrato, $listaDatosReembolso, $fechaActual)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CREAR_REEMBOLSO_CLIENTE_PYMES(:idBayer,:idContrato,:listaDatosReembolso,:fechaActual)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaDatosReembolso', $listaDatosReembolso, PDO::PARAM_STR);
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
     *******MODIFICAR VALIDAR REEMBOLSO CLIENTE
     ***********************************/
    function Modificar_Reembolso_Validar($idReembolso, $listaValidarDatosReembolso, $listaObservacionesDatosReembolso, $fecha_seguimiento_validar, $contar_validar, $fechaActual, $fechaActual1)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_REEMBOLSO_VALIDAR_CLIENTE_PYMES(:idReembolso,:listaValidarDatosReembolso,:listaObservacionesDatosReembolso,:fecha_seguimiento_validar,:contar_validar,:fechaActual,:fechaActual1)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':listaValidarDatosReembolso', $listaValidarDatosReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesDatosReembolso', $listaObservacionesDatosReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento_validar', $fecha_seguimiento_validar, PDO::PARAM_STR);
        $stmt->bindParam(':contar_validar', $contar_validar, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE OBSERVACIONES ADICIONALES
     ***********************************/

    function listar_observacion_reembolsos($idReembolso)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_OBSERVACIONES_REEMBOLSOS_PYMES(:idReembolso)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE OBSERVACIONES ADICIONALES
     ***********************************/

    function listar_documentos_solicitados_aseguradora_reembolsos($idReembolso)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_DOCUMENTOS_SOLICITADOS_ASEGURADORA_REEMBOLSOS_PYMES(:idReembolso)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR LIQUIDACION REEMBOLSO CLIENTE
     ***********************************/
    function Modificar_Reembolso_Liquidacion($idReembolso, $idBayer, $idContrato, $lista_dependientes, $deducible_contrato, $valor_cobrado, $saldo_deducible, $valor_presentado, $valor_no_cubierto, $valor_copago, $valor_reembolsado, $fechaActual, $listaObservacionesLiquidacionReembolso, $fechaActual1)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_REEMBOLSO_LIQUIDACION_CLIENTE_PYMES(:idReembolso,:idBayer,:idContrato,:lista_dependientes,:deducible_contrato,:valor_cobrado,:saldo_deducible,:valor_presentado,:valor_no_cubierto,:valor_reembolsado,:fechaActual,:valor_copago,:listaObservacionesLiquidacionReembolso,:fechaActual1)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':lista_dependientes', $lista_dependientes, PDO::PARAM_STR);
        $stmt->bindParam(':deducible_contrato', $deducible_contrato, PDO::PARAM_STR);
        $stmt->bindParam(':valor_cobrado', $valor_cobrado, PDO::PARAM_STR);
        $stmt->bindParam(':saldo_deducible', $saldo_deducible, PDO::PARAM_STR);
        $stmt->bindParam(':valor_presentado', $valor_presentado, PDO::PARAM_STR);
        $stmt->bindParam(':valor_no_cubierto', $valor_no_cubierto, PDO::PARAM_STR);
        $stmt->bindParam(':valor_reembolsado', $valor_reembolsado, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':valor_copago', $valor_copago, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesLiquidacionReembolso', $listaObservacionesLiquidacionReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR SEGUIMIENTO REEMBOLSO CLIENTE
     ***********************************/
    function Modificar_Reembolso_Seguimiento($idReembolso, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosReembolso, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_REEMBOLSO_SEGUIMIENTO_CLIENTE_PYMES(:idReembolso,:listaDocumentosSolicitadosAseguradora,:listaObservacionesSeguimientosReembolso,:fecha_seguimiento,:fechaActual,:fechaActual1,:estado_caducado)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':listaDocumentosSolicitadosAseguradora', $listaDocumentosSolicitadosAseguradora, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesSeguimientosReembolso', $listaObservacionesSeguimientosReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);
        $stmt->bindParam(':estado_caducado', $estado_caducado, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    function Modificar_Reembolso_Seguimiento_1($idReembolso, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosReembolso, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_REEMBOLSO_SEGUIMIENTO_CLIENTE_PYMES_1(:idReembolso,:listaDocumentosSolicitadosAseguradora,:listaObservacionesSeguimientosReembolso,:fecha_seguimiento,:fechaActual,:fechaActual1,:estado_caducado)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':listaDocumentosSolicitadosAseguradora', $listaDocumentosSolicitadosAseguradora, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesSeguimientosReembolso', $listaObservacionesSeguimientosReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);
        $stmt->bindParam(':estado_caducado', $estado_caducado, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR SEGUIMIENTO REEMBOLSO CLIENTE
     ***********************************/
    function Modificar_Envio_Reembolso_Seguimiento($idReembolso, $fecha_seguimiento, $listaObservacionesDocumentoSeguimientosReembolso, $fechaActual, $fechaActual1)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_REEMBOLSO_SEGUIMIENTO_ASEGURADORA_PYMES(:idReembolso,:fecha_seguimiento,:listaObservacionesDocumentoSeguimientosReembolso,:fechaActual,:fechaActual1)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesDocumentoSeguimientosReembolso', $listaObservacionesDocumentoSeguimientosReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR REACTIVAR REEMBOLSO CLIENTE
     ***********************************/
    function Modificar_Reembolso_Reactivar($idReembolso, $estado)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_REEMBOLSO_REACTIVAR_CLIENTE(:idReembolso,:estado)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idReembolso', $idReembolso, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }
}

<?php
require_once 'modelo_conexion.php';

class Modelo_Operatorio_Cliente extends conexionBD
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = parent::conexionPDO();
    }

    /***********************************
     *******CONSULTAR LISTA DE OPERATORIOS
     ***********************************/

    function listar_operatorio_asistencia_medica($idCategoria)
    {

        $sql = 'CALL SP_LISTAR_OPERATORIOS_ASISTENCIA_MEDICA(:categoria_id)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******CONSULTAR LISTA DE OPERATORIOS de CLIENTES
     ***********************************/

    function listar_operatorio_cliente_asistencia_medica($idCliente, $idCategoria)
    {



        $sql = 'CALL SP_LISTAR_OPERATORIOS_CLIENTES_ASISTENCIA_MEDICA(:cliente_id,:categoria_id)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':cliente_id', $idCliente, PDO::PARAM_STR);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******CONSULTAR UNICO OPERATORIO
     ***********************************/

    function traer_operatorio_unico($idOperatorio, $idContrato)
    {



        $sql = 'CALL SP_LISTAR_OPERATORIOS_ASISTENCIA_MEDICA_IDOPERATORIO(:idOperatorio,:idContrato)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******CREAR NUEVO REGRISTRO OPERATORIO CLIENTE
     ***********************************/
    function Registrar_Operatorio($idBayer, $idContrato, $listaDatosOperatorio, $fechaActual, $fechaActual1)
    {



        $sql = 'CALL SP_CREAR_OPERATORIO_CLIENTE(:idBayer,:idContrato,:listaDatosOperatorio,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaDatosOperatorio', $listaDatosOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        $arreglo = array();

        foreach ($respuesta as $value) {

            $arreglo[] = $value;
        }
        return $arreglo;
    }

    /***********************************
     *******MODIFICAR VALIDAR REEMBOLSO CLIENTE
     ***********************************/
    function Modificar_Operatorio_Validar($idOperatorio, $listaValidarDatosOperatorio, $listaObservacionesDatosOperatorio, $fecha_seguimiento_validar, $contar_validar, $fechaActual, $fechaActual1)
    {



        $sql = 'CALL SP_MODIFICAR_OPERATORIO_VALIDAR_CLIENTE(:idOperatorio,:listaValidarDatosOperatorio,:listaObservacionesDatosOperatorio,:fecha_seguimiento_validar,:contar_validar,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':listaValidarDatosOperatorio', $listaValidarDatosOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesDatosOperatorio', $listaObservacionesDatosOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento_validar', $fecha_seguimiento_validar, PDO::PARAM_STR);
        $stmt->bindParam(':contar_validar', $contar_validar, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        try {
            return $stmt->execute() ? 1 : 0;
        } catch (PDOException $e) {
            // Manejar el error según tus necesidades
            return 0;
        }
    }

    /***********************************
     *******CONSULTAR LISTA DE OBSERVACIONES ADICIONALES
     ***********************************/

    function listar_observacion_operatorios($idOperatorio)
    {

        $sql = 'CALL SP_LISTAR_OBSERVACIONES_OPERATORIOS(:idOperatorio)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }


    /***********************************
     *******CONSULTAR LISTA DE OBSERVACIONES ADICIONALES
     ***********************************/

    function listar_documentos_solicitados_aseguradora_operatorios($idOperatorio)
    {

        $sql = 'CALL SP_LISTAR_DOCUMENTOS_SOLICITADOS_ASEGURADORA_OPERATORIOS(:idOperatorio)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******MODIFICAR AUTORIZACION OPERATORIO CLIENTE
     ***********************************/
    function Modificar_Operatorio_Autorizacion($idOperatorio, $listaObservacionesAutorizacionOperatorio, $fechaActual, $fechaActual1)
    {

        $sql = 'CALL SP_MODIFICAR_OPERATORIO_AUTORIZACION_CLIENTE(:idOperatorio,:listaObservacionesAutorizacionOperatorio,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesAutorizacionOperatorio', $listaObservacionesAutorizacionOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        try {
            return $stmt->execute() ? 1 : 0;
        } catch (PDOException $e) {
            // Manejar el error según tus necesidades
            return 0;
        }
    }
    /***********************************
     *******MODIFICAR SEGUIMIENTO OPERATORIO CLIENTE
     ***********************************/
    function Modificar_Operatorio_Seguimiento($idOperatorio, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosOperatorio, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado)
    {

        $sql = 'CALL SP_MODIFICAR_OPERATORIO_SEGUIMIENTO_CLIENTE(:idOperatorio,:listaDocumentosSolicitadosAseguradora,:listaObservacionesSeguimientosOperatorio,:fecha_seguimiento,:fechaActual,:fechaActual1,:estado_caducado)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':listaDocumentosSolicitadosAseguradora', $listaDocumentosSolicitadosAseguradora, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesSeguimientosOperatorio', $listaObservacionesSeguimientosOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);
        $stmt->bindParam(':estado_caducado', $estado_caducado, PDO::PARAM_STR);

        try {
            return $stmt->execute() ? 1 : 0;
        } catch (PDOException $e) {
            // Manejar el error según tus necesidades
            return 0;
        }
    }

    /***********************************
     *******MODIFICAR SEGUIMIENTO OPERATORIO CLIENTE
     ***********************************/
    function Modificar_Operatorio_Seguimiento_1($idOperatorio, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosOperatorio, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado)
    {

        $sql = 'CALL SP_MODIFICAR_OPERATORIO_SEGUIMIENTO_CLIENTE_1(:idOperatorio,:listaDocumentosSolicitadosAseguradora,:listaObservacionesSeguimientosOperatorio,:fecha_seguimiento,:fechaActual,:fechaActual1,:estado_caducado)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':listaDocumentosSolicitadosAseguradora', $listaDocumentosSolicitadosAseguradora, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesSeguimientosOperatorio', $listaObservacionesSeguimientosOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);
        $stmt->bindParam(':estado_caducado', $estado_caducado, PDO::PARAM_STR);

        try {
            return $stmt->execute() ? 1 : 0;
        } catch (PDOException $e) {
            // Manejar el error según tus necesidades
            return 0;
        }
    }
    /***********************************
     *******MODIFICAR SEGUIMIENTO PEDIDO OPERATORIO CLIENTE
     ***********************************/
    function Modificar_Envio_Operatorio_Seguimiento($idOperatorio, $fecha_seguimiento, $listaObservacionesDocumentoSeguimientosOperatorio, $fechaActual, $fechaActual1)
    {

        $sql = 'CALL SP_MODIFICAR_OPERATORIO_SEGUIMIENTO_ASEGURADORA(:idOperatorio,:fecha_seguimiento,:listaObservacionesDocumentoSeguimientosOperatorio,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservacionesDocumentoSeguimientosOperatorio', $listaObservacionesDocumentoSeguimientosOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        try {
            return $stmt->execute() ? 1 : 0;
        } catch (PDOException $e) {
            // Manejar el error según tus necesidades
            return 0;
        }
    }
}
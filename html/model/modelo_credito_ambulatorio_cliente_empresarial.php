<?php
require_once 'modelo_conexion.php';

class Modelo_Credito_Ambulatorio_Cliente_Empresarial extends conexionBD
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = parent::conexionPDO();
    }
    /***********************************
     *******CONSULTAR LISTA DE OPERATORIOS
     ***********************************/

    function listar_credito_ambulatorio_asistencia_medica($idCategoria)
    {



        $sql = 'CALL SP_LISTAR_CREDITOS_AMBULATORIOS_ASISTENCIA_MEDICA_PYMES(:categoria_id)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******CONSULTAR LISTA DE OPERATORIOS de CLIENTES
     ***********************************/

    function listar_credito_ambulatorio_cliente_asistencia_medica($idCliente, $idCategoria)
    {



        $sql = 'CALL SP_LISTAR_CREDITOS_AMBULATORIOS_CLIENTES_ASISTENCIA_MEDICA_PYMES(:cliente_id,:categoria_id)';

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

    function traer_credito_ambulatorio_unico($idCreditoAmbulatorio, $idContrato)
    {



        $sql = 'CALL SP_LISTAR_CREDITO_AMBULATORIO_ASIST_MEDICA_IDOPERATORIO_PYMES(:idCreditoAmbulatorio,:idContrato)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******CREAR NUEVO REGRISTRO OPERATORIO CLIENTE
     ***********************************/
    function Registrar_Credito_Ambulatorio($idBayer, $idContrato, $listaDatosOperatorio, $fechaActual, $fechaActual1)
    {



        $sql = 'CALL SP_CREAR_CREDITO_AMBULATORIO_CLIENTE_PYMES(:idBayer,:idContrato,:listaDatosOperatorio,:fechaActual,:fechaActual1)';

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
    function Modificar_Credito_Ambulatorio_Validar($idCreditoAmbulatorio, $listaValidarDatosOperatorio, $listaObservacionesDatosOperatorio, $fecha_seguimiento_validar, $contar_validar, $fechaActual, $fechaActual1)
    {



        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_VALIDAR_CLIENTE_PYMES(:idCreditoAmbulatorio,:listaValidarDatosOperatorio,:listaObservacionesDatosOperatorio,:fecha_seguimiento_validar,:contar_validar,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
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

    function listar_observacion_creditos_ambulatorios($idCreditoAmbulatorio)
    {



        $sql = 'CALL SP_LISTAR_OBSERVACIONES_CREDITOS_AMBULATORIOS_PYMES(:idCreditoAmbulatorio)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }


    /***********************************
     *******CONSULTAR LISTA DE OBSERVACIONES ADICIONALES
     ***********************************/

    function listar_documentos_solicitados_aseguradora_creditos_ambulatorios($idCreditoAmbulatorio)
    {



        $sql = 'CALL SP_LISTAR_DOCUMENTO_SOLICITADO_ASEGURADORA_CRED_AMBULA_PYMES(:idCreditoAmbulatorio)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******MODIFICAR AUTORIZACION OPERATORIO CLIENTE
     ***********************************/
    function Modificar_Credito_Ambulatorio_Autorizacion($idCreditoAmbulatorio, $listaObservacionesAutorizacionOperatorio, $fechaActual, $fechaActual1)
    {



        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_AUTORIZACION_CLIENTE_PYMES(:idCreditoAmbulatorio,:listaObservacionesAutorizacionOperatorio,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
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
    function Modificar_Credito_Ambulatorio_Seguimiento($idCreditoAmbulatorio, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosOperatorio, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado)
    {
        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_SEGUIMIENTO_CLIENTE_PYMES(:idCreditoAmbulatorio,:listaDocumentosSolicitadosAseguradora,:listaObservacionesSeguimientosOperatorio,:fecha_seguimiento,:fechaActual,:fechaActual1,:estado_caducado)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
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
    function Modificar_Credito_Ambulatorio_Seguimiento_1($idCreditoAmbulatorio, $listaDocumentosSolicitadosAseguradora, $listaObservacionesSeguimientosOperatorio, $fecha_seguimiento, $fechaActual, $fechaActual1, $estado_caducado)
    {
        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_SEGUIMIENTO_CLIENTE_PYMES_1(:idCreditoAmbulatorio,:listaDocumentosSolicitadosAseguradora,:listaObservacionesSeguimientosOperatorio,:fecha_seguimiento,:fechaActual,:fechaActual1,:estado_caducado)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
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
    function Modificar_Envio_Credito_Ambulatorio_Seguimiento($idCreditoAmbulatorio, $fecha_seguimiento, $listaObservacionesDocumentoSeguimientosOperatorio, $fechaActual, $fechaActual1)
    {



        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_SEGUIMIENTO_ASEGURADORA_PYMES(:idCreditoAmbulatorio,:fecha_seguimiento,:listaObservacionesDocumentoSeguimientosOperatorio,:fechaActual,:fechaActual1)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':idCreditoAmbulatorio', $idCreditoAmbulatorio, PDO::PARAM_STR);
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
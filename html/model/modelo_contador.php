<?php
require_once 'modelo_conexion.php';

class Modelo_Contador  extends conexionBD
{

    /***********************************
     *******CONSULTAR CONTAR PROSPECTO WEB
     ***********************************/
    function listar_contador_prospecto_web()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_PROSPECTO_WEB()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR PROSPECTOS
     ***********************************/
    function listar_contador_prospectos()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_PROSPECTOS()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR PROSPECTOS EMPRESARIALES
     ***********************************/
    function listar_contador_prospectos_empresariales()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_PROSPECTOS_PYMES()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR PROSPECTOS ASIGNADO
     ***********************************/
    function listar_contador_prospectos_asignado($idUsuario)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_PROSPECTOS_ASIGNADOS(:idUsuario)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR PROSPECTOS ASIGNADO
     ***********************************/
    function listar_contador_prospectos_asignado_empresariales($idUsuario)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_PROSPECTOS_ASIGNADOS_PYMES(:idUsuario)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR CONTRATOS
     ***********************************/
    function listar_contador_contratos($idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CONTRATOS(:idCategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR CONTRATOS CLIENTES
     ***********************************/
    function listar_contador_contratos_cliente($idUsuario, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CONTRATOS_CLIENTE(:idUsuario,:idCategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR REEMBOLSOS CLIENTES
     ***********************************/
    function listar_contador_reembolsos_cliente($idUsuario)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_REEMBOLSOS_CLIENTE(:idUsuario)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR REEMBOLSOS ASISTENCIA MEDICA
     ***********************************/
    function listar_contador_reembolsos_asistencia_medica()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_REEMBOLSOS()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR REEMBOLSOS ASISTENCIA MEDICA PYMES
     ***********************************/
    function listar_contador_reembolsos_asistencia_medica_empresarial()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_REEMBOLSOS_PYMES()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR CREDITOS HOSPITALARIOS ASISTENCIA MEDICA
     ***********************************/
    function listar_contador_creditos_hospitalarios_asistencia_medica()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CREDITOS_HOSPITALARIOS()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR CREDITOS HOSPITALARIOS ASISTENCIA MEDICA PYMES
     ***********************************/
    function listar_contador_creditos_hospitalarios_asistencia_medica_empresarial()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CREDITOS_HOSPITALARIOS_PYMES()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR CREDITOS AMBULATORIOS ASISTENCIA MEDICA
     ***********************************/
    function listar_contador_creditos_ambulatorios_asistencia_medica()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CREDITOS_AMBULATORIOS()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
    /***********************************
     *******CONSULTAR CONTAR CREDITOS AMBULATORIOS ASISTENCIA MEDICA
     ***********************************/
    function listar_contador_creditos_ambulatorios_asistencia_medica_empresarial()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CREDITOS_AMBULATORIOS_PYMES()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR CONTAR SINIESTROS VEHICULOS
     ***********************************/
    function listar_contador_siniestros_vehiculo_individual()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_SINIESTROS_VEHICULOS()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
    /***********************************
     *******CONSULTAR CONTAR SINIESTROS VEHICULOS
     ***********************************/
    function listar_contador_siniestros_hogar_individual()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_SINIESTROS_HOGARES()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
}

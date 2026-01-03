<?php
require_once 'modelo_conexion.php';

class Modelo_Notificaciones  extends conexionBD
{

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO
     ***********************************/
    function listar_prospectos_seguimiento($fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_SEGUIMIENTO(:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_prospectos_seguimiento_asignado($idUsuario, $fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO
     ***********************************/
    function listar_prospectos_alto_seguimiento($fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_ALTO_SEGUIMIENTO(:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_prospectos_alto_seguimiento_asignado($idUsuario, $fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_ALTO_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO
     ***********************************/
    function listar_prospectos_medio_seguimiento($fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_MEDIO_SEGUIMIENTO(:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_prospectos_medio_seguimiento_asignado($idUsuario, $fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_MEDIO_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO
     ***********************************/
    function listar_prospectos_bajo_seguimiento($fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_BAJO_SEGUIMIENTO(:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_prospectos_bajo_seguimiento_asignado($idUsuario, $fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTO_BAJO_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO
     ***********************************/
    function listar_clientes_seguimiento($fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CLIENTE_SEGUIMIENTO(:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS O CLIENTES SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_clientes_seguimiento_asignado($idUsuario, $fechaActual, $tipo, $categoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CLIENTE_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:tipo,:categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE RENOVACIONES
     ***********************************/
    function listar_renovaciones_seguimiento($fechaActual, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_RENOVACIONES_SEGUIMIENTO(:fechaActual,:idCategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }


    /***********************************
     *******CONSULTAR LISTA DE REEMBOLSOS SEGUIMIENTO
     ***********************************/
    function listar_reembolso_seguimiento($fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_REEMBOLSOS_SEGUIMIENTO(:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE REEMBOLSOS SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_reembolso_seguimiento_asignado($idUsuario, $fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_REEMBOLSOS_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CREDITOS HOSPITALARIOS SEGUIMIENTO
     ***********************************/
    function listar_credito_hospitalario_seguimiento($fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CREDITOS_HOSPITALARIOS_SEGUIMIENTO(:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
    /***********************************
     *******CONSULTAR LISTA DE CREDITOS HOSPITALARIOS SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_credito_hospitalario_seguimiento_asignado($idUsuario, $fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CREDITOS_HOSPITALARIOS_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CREDITOS AMBULATORIOS SEGUIMIENTO
     ***********************************/
    function listar_credito_ambulatorio_seguimiento($fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CREDITOS_AMBULATORIOS_SEGUIMIENTO(:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CREDITOS AMBULATORIOS SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_credito_ambulatorio_seguimiento_asignado($idUsuario, $fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_CREDITOS_AMBULATORIOS_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE SINIESTROS SEGUIMIENTO
     ***********************************/
    function listar_siniestro_seguimiento($fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_SINIESTROS_SEGUIMIENTO(:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE REEMBOLSOS SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_siniestro_seguimiento_asignado($idUsuario, $fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_SINIESTROS_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE SINIESTROS SEGUIMIENTO
     ***********************************/
    function listar_siniestro_transporte_seguimiento($fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_SINIESTROS_SEGUIMIENTO(:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE REEMBOLSOS SEGUIMIENTO ASIGNADOS
     ***********************************/
    function listar_siniestro_seguimiento_transporte_asignado($idUsuario, $fechaActual, $idategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_SINIESTROS_SEGUIMIENTO_ASIGNADO(:idUsuario,:fechaActual,:idategoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':idategoria', $idategoria, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
}

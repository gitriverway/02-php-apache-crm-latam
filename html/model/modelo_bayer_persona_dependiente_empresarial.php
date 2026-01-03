<?php
require_once 'modelo_conexion.php';

class Modelo_Bayer_Persona_Dependiente_Empresarial extends conexionBD
{

    /***********************************
     *******CONSULTAR UNICO BAYER
     ***********************************/

    function TraerDatosBayerDependiente($idProspecto)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_BAYER_DEPENDIENTES_PYMES(:id_prospecto)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR UNICO BAYER
     ***********************************/

    function TraerDatosBayerDependienteActivo($idProspecto)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_BAYER_DEPENDIENTES_ACTIVO_PYMES(:id_prospecto)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR DEPENDIENTES BAYER PERSONA
     ***********************************/
    function Modificar_Dependientes($idBayer, $idDependientes, $idContrato, $listaFamiliares, $listaVehiculos, $contra_numero, $fecha_inicio, $fecha_fin, $estado_pago, $fechaActual, $estado_contrato, $envio_condiciones, $ruta_condiciones)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_BAYER_DEPENDIENTES_ASISTENCIA_MEDICA_PYMES(:idBayer,:idDependientes,:idContrato,:listaFamiliares,:listaVehiculos,:contra_numero,:fecha_inicio,:fecha_fin,:estado_pago,:fechaActual,:estado_contrato,:envio_condiciones,:ruta_condiciones)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idDependientes', $idDependientes, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaFamiliares', $listaFamiliares, PDO::PARAM_STR);
        $stmt->bindParam(':listaVehiculos', $listaVehiculos, PDO::PARAM_STR);
        $stmt->bindParam(':contra_numero', $contra_numero, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':estado_contrato', $estado_contrato, PDO::PARAM_STR);
        $stmt->bindParam(':envio_condiciones', $envio_condiciones, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_condiciones', $ruta_condiciones, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR DEPENDIENTES BAYER PERSONA
     ***********************************/
    function Modificar_Dependientes_Asistencia_Medica_Pymes($idBayer, $idDependientes, $idContrato, $listaFamiliares, $listaVehiculos, $listaCondiciones, $contra_numero, $fecha_inicio, $fecha_fin, $estado_pago, $fechaActual, $estado_contrato, $envio_condiciones, $ruta_condiciones)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_BAYER_DEPENDIENTES_ASISTENCIA_MEDICA_PYMES(:idBayer,:idDependientes,:idContrato,:listaFamiliares,:listaVehiculos,:listaCondiciones,:contra_numero,:fecha_inicio,:fecha_fin,:estado_pago,:fechaActual,:estado_contrato,:envio_condiciones,:ruta_condiciones)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idDependientes', $idDependientes, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaFamiliares', $listaFamiliares, PDO::PARAM_STR);
        $stmt->bindParam(':listaVehiculos', $listaVehiculos, PDO::PARAM_STR);
        $stmt->bindParam(':listaCondiciones', $listaCondiciones, PDO::PARAM_STR);
        $stmt->bindParam(':contra_numero', $contra_numero, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':estado_contrato', $estado_contrato, PDO::PARAM_STR);
        $stmt->bindParam(':envio_condiciones', $envio_condiciones, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_condiciones', $ruta_condiciones, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR DEPENDIENTES BAYER PERSONA RESPONSABILIDAD CIVIL
     ***********************************/
    function Modificar_Dependientes_Responsabilidad_Civil_Pymes($idBayer, $idDependientes, $idContrato, $listaFamiliares, $listaVehiculos, $listaCondiciones, $contra_numero, $fecha_inicio, $fecha_fin, $estado_pago, $fechaActual, $estado_contrato, $envio_condiciones, $ruta_condiciones)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_BAYER_DEPENDIENTES_RESPONSABILIDAD_CIVIL_PYMES(:idBayer,:idDependientes,:idContrato,:listaFamiliares,:listaVehiculos,:listaCondiciones,:contra_numero,:fecha_inicio,:fecha_fin,:estado_pago,:fechaActual,:estado_contrato,:envio_condiciones,:ruta_condiciones)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idDependientes', $idDependientes, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaFamiliares', $listaFamiliares, PDO::PARAM_STR);
        $stmt->bindParam(':listaVehiculos', $listaVehiculos, PDO::PARAM_STR);
        $stmt->bindParam(':listaCondiciones', $listaCondiciones, PDO::PARAM_STR);
        $stmt->bindParam(':contra_numero', $contra_numero, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':estado_contrato', $estado_contrato, PDO::PARAM_STR);
        $stmt->bindParam(':envio_condiciones', $envio_condiciones, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_condiciones', $ruta_condiciones, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR DEPENDIENTES BAYER PERSONA
     ***********************************/
    function Modificar_Dependientes_Incendio($idBayer, $idDependientes, $idContrato, $listaHogares, $listaCondiciones, $contra_numero, $fecha_inicio, $fecha_fin, $estado_pago, $fechaActual, $estado_contrato, $envio_condiciones, $ruta_condiciones)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_BAYER_DEPENDIENTES_HOGAR(:idBayer,:idDependientes,:idContrato,:listaHogares,:listaCondiciones,:contra_numero,:fecha_inicio,:fecha_fin,:estado_pago,:fechaActual,:estado_contrato,:envio_condiciones,:ruta_condiciones)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idDependientes', $idDependientes, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaHogares', $listaHogares, PDO::PARAM_STR);
        $stmt->bindParam(':listaCondiciones', $listaCondiciones, PDO::PARAM_STR);
        $stmt->bindParam(':contra_numero', $contra_numero, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':estado_contrato', $estado_contrato, PDO::PARAM_STR);
        $stmt->bindParam(':envio_condiciones', $envio_condiciones, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_condiciones', $ruta_condiciones, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR DEPENDIENTES BAYER PERSONA
     ***********************************/

    function Modificar_Dependientes_Transporte($idBayer, $idDependientes, $idContrato, $listaTransportes, $listaCondiciones, $contra_numero, $fecha_inicio, $fecha_fin, $estado_pago, $fechaActual, $estado_contrato, $envio_condiciones, $ruta_condiciones)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_BAYER_DEPENDIENTES_TRANSPORTE(:idBayer,:idDependientes,:idContrato,:listaTransportes,:listaCondiciones,:contra_numero,:fecha_inicio,:fecha_fin,:estado_pago,:fechaActual,:estado_contrato,:envio_condiciones,:ruta_condiciones)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':idDependientes', $idDependientes, PDO::PARAM_STR);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_STR);
        $stmt->bindParam(':listaTransportes', $listaTransportes, PDO::PARAM_STR);
        $stmt->bindParam(':listaCondiciones', $listaCondiciones, PDO::PARAM_STR);
        $stmt->bindParam(':contra_numero', $contra_numero, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':estado_contrato', $estado_contrato, PDO::PARAM_STR);
        $stmt->bindParam(':envio_condiciones', $envio_condiciones, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_condiciones', $ruta_condiciones, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }
}
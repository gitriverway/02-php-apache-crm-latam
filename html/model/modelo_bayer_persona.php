<?php
require_once 'modelo_conexion.php';

class Modelo_Bayer_Persona extends conexionBD
{

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS WEB CHAT
     ***********************************/

    function listar_prospecto_chat($idProspecto)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTOS_CHAT(:id_prospecto)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CLIENTES VIDA INDIVIDUAL
     ***********************************/

    function listar_cliente_vida_individual($idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_BAYER_PERSONAS(:id_categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CLIENTES VEHICULO INDIVIDUAL
     ***********************************/

    function listar_cliente_vehiculo_individual($idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_BAYER_PERSONAS(:id_categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CLIENTES VIDA INDIVIDUAL ASIGNADOS
     ***********************************/

    function listar_cliente_vida_individual_asignados($idUsuario, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_BAYER_PERSONAS_ASIGNADOS(:id_usuario,:id_categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CLIENTES VEHICULOS INDIVIDUAL ASIGNADOS
     ***********************************/

    function listar_cliente_vehiculo_individual_asignados($idUsuario, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_BAYER_PERSONAS_ASIGNADOS(:id_usuario,:id_categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR VENDEDOR ASIGNADO A CLIENTE
     ***********************************/
    function Modificar_Vendedor_Asigando_Cliente($idCliente, $idEmpleado)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_VENDEDOR_ASIGANDO_CLIENTE(:id_cliente,:id_empleado)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR ESADO BAYER DE CLIENTE
     ***********************************/
    function Modificar_Estado_Bayer_Cliente($idCliente, $estadoBayer)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_ESTADO_BAYER_CLIENTE(:id_cliente,:estado_bayer)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':estado_bayer', $estadoBayer, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR UNICO BAYER
     ***********************************/

    function TraerDatosBayer($idProspecto, $tipo)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_BAYER_PERSONA(:id_prospecto,:tipo)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR UNICO BAYER
     ***********************************/

    function TraerDatosBayerContrato($idProspecto)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_BAYER_CONTRATO(:id_prospecto)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    function listar_observacion_cliente($idCliente)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_OBSERVACIONES_CLIENTES(:id_cliente)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }


    function listar_observacion_prospecto($idProspecto)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_OBSERVACIONES_PROSPECTOS(:id_prospecto)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }


    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS ASIGNADOS
     ***********************************/

    function listar_prospecto()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTOS()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }


    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS 
     ***********************************/

    function listar_prospecto_asignado($idUsuario)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_PROSPECTOS_ASIGNADOS(:id_usuario)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }



    /***********************************
     *******CREAR NUEVO REGRISTRO PROSPECTO
     ***********************************/
    function Registrar_Prospecto($origen, $categoria, $idCliente, $cedula, $nombre_prospecto, $fecha_nacimiento, $genero, $estado_civil, $telefono, $email, $provincia, $ciudad, $direccion, $ocupacion, $valor_ingreso, $valor_asegurado, $prima_total, $tipo_pago, $forma_pago, $listaObservaciones, $idUsuario, $estado_bayer, $idProducto, $fechaActual, $proveedor, $contra, $fecha_seguimiento, $prima_comisionable, $prima_neta, $nueva_categoria, $listaFamiliares, $listaVehiculos, $listaHogares)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CREAR_PROSPECTO(:origen,:categoria,:cedula,:nombre_prospecto,:fecha_nacimiento,:genero,:estado_civil,:telefono,:email,:provincia,:ciudad,:direccion,:ocupacion,:valor_ingreso,:valor_asegurado,:prima_total,:tipo_pago,:forma_pago,:lista_observacion,:idUsuario,:estado_bayer,:idProducto,:fecha_actual,:proveedor,:contra,:fecha_seguimiento,:idCliente,:prima_comisionable,:prima_neta,:nueva_categoria,:listaFamiliares,:listaVehiculos,:listaHogares)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_prospecto', $nombre_prospecto, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':estado_civil', $estado_civil, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':provincia', $provincia, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':ocupacion', $ocupacion, PDO::PARAM_STR);
        $stmt->bindParam(':valor_ingreso', $valor_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':valor_asegurado', $valor_asegurado, PDO::PARAM_STR);
        $stmt->bindParam(':prima_total', $prima_total, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':forma_pago', $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(':lista_observacion', $listaObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':estado_bayer', $estado_bayer, PDO::PARAM_STR);
        $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_actual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':prima_comisionable', $prima_comisionable, PDO::PARAM_STR);
        $stmt->bindParam(':prima_neta', $prima_neta, PDO::PARAM_STR);
        $stmt->bindParam(':nueva_categoria', $nueva_categoria, PDO::PARAM_STR);
        $stmt->bindParam(':listaFamiliares', $listaFamiliares, PDO::PARAM_STR);
        $stmt->bindParam(':listaVehiculos', $listaVehiculos, PDO::PARAM_STR);
        $stmt->bindParam(':listaHogares', $listaHogares, PDO::PARAM_STR);


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
     *******MODIFICAR PROSPECTO
     ***********************************/
    function Modificar_Prospecto($idBayer, $origen, $categoria, $cedula, $nombre_prospecto, $fecha_nacimiento, $genero, $estado_civil, $telefono, $email, $provincia, $ciudad, $direccion, $ocupacion, $valor_ingreso, $valor_asegurado, $prima_total, $tipo_pago, $forma_pago, $listaObservaciones, $idUsuario, $estado_bayer, $idProducto, $fechaActual, $proveedor, $contra, $fecha_seguimiento, $idCliente, $prima_comisionable, $prima_neta, $nueva_categoria, $idDependiente, $listaFamiliares, $listaVehiculos, $idEmpleado, $listaHogares)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_PROSPECTO(:idBayer,:origen,:categoria,:cedula,:nombre_prospecto,:fecha_nacimiento,:genero,:estado_civil,:telefono,:email,:provincia,:ciudad,:direccion,:ocupacion,:valor_ingreso,:valor_asegurado,:prima_total,:tipo_pago,:forma_pago,:lista_observacion,:idUsuario,:estado_bayer,:idProducto,:fecha_actual,:proveedor,:contra,:fecha_seguimiento,:idCliente,:prima_comisionable,:prima_neta,:nueva_categoria,:idDependiente,:lista_familia,:lista_vehiculo,:idEmpleado,:listaHogares)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_prospecto', $nombre_prospecto, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':estado_civil', $estado_civil, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':provincia', $provincia, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':ocupacion', $ocupacion, PDO::PARAM_STR);
        $stmt->bindParam(':valor_ingreso', $valor_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':valor_asegurado', $valor_asegurado, PDO::PARAM_STR);
        $stmt->bindParam(':prima_total', $prima_total, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':forma_pago', $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(':lista_observacion', $listaObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':estado_bayer', $estado_bayer, PDO::PARAM_STR);
        $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_actual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':prima_comisionable', $prima_comisionable, PDO::PARAM_STR);
        $stmt->bindParam(':prima_neta', $prima_neta, PDO::PARAM_STR);
        $stmt->bindParam(':nueva_categoria', $nueva_categoria, PDO::PARAM_STR);
        $stmt->bindParam(':idDependiente', $idDependiente, PDO::PARAM_STR);
        $stmt->bindParam(':lista_familia', $listaFamiliares, PDO::PARAM_STR);
        $stmt->bindParam(':lista_vehiculo', $listaVehiculos, PDO::PARAM_STR);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_STR);
        $stmt->bindParam(':listaHogares', $listaHogares, PDO::PARAM_STR);

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
     *******MODIFICAR CLIENTE
     ***********************************/
    function Modificar_Cliente($idBayer, $origen, $categoria, $cedula, $nombre, $fecha_nacimiento, $genero, $telefono, $email, $provincia, $ciudad, $direccion, $ocupacion, $valor_ingreso, $valor_asegurado, $prima_total, $tipo_pago, $forma_pago, $idUsuario, $estado_bayer, $idProducto, $fechaActual, $proveedor, $contra, $fecha_seguimiento, $listaObservaciones, $idCliente, $prima_comisionable, $prima_neta, $telefono_opcional, $email_opcional, $idEmpleado, $estado_civil, $edad_nacimiento)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_BAYER(:idBayer,:origen,:categoria,:cedula,:nombre,:fecha_nacimiento,:genero,:telefono,:email,:provincia,:ciudad,:direccion,:ocupacion,:valor_ingreso,:valor_asegurado,:prima_total,:tipo_pago,:forma_pago,:idUsuario,:estado_bayer,:idProducto,:fecha_actual,:proveedor,:contra,:fecha_seguimiento,:listaObservaciones,:idCliente,:prima_comisionable,:prima_neta,:telefono_opcional,:email_opcional,:idEmpleado,:estado_civil,:edad_nacimiento)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_STR);
        $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':provincia', $provincia, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':ocupacion', $ocupacion, PDO::PARAM_STR);
        $stmt->bindParam(':valor_ingreso', $valor_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':valor_asegurado', $valor_asegurado, PDO::PARAM_STR);
        $stmt->bindParam(':prima_total', $prima_total, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':forma_pago', $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':estado_bayer', $estado_bayer, PDO::PARAM_STR);
        $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_actual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':listaObservaciones', $listaObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':prima_comisionable', $prima_comisionable, PDO::PARAM_STR);
        $stmt->bindParam(':prima_neta', $prima_neta, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_opcional', $telefono_opcional, PDO::PARAM_STR);
        $stmt->bindParam(':email_opcional', $email_opcional, PDO::PARAM_STR);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_STR);
        $stmt->bindParam(':estado_civil', $estado_civil, PDO::PARAM_STR);
        $stmt->bindParam(':edad_nacimiento', $edad_nacimiento, PDO::PARAM_STR);

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
     *******CONSULTAR LISTA DE CLIENTES VIDA INDIVIDUAL
     ***********************************/

    function listar_dependientes_asistencia_medica($idBayer, $idContrato)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_DEPENDIENTES_ASISTENCIA_MEDICA(:idBayer,:idContrato)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_INT);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    function listar_vehiculos_individual($idBayer, $idContrato)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_VEHICULOS_INDIVIDUAL(:idBayer,:idContrato)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_INT);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CLIENTES HOGAR INDIVIDUAL
     ***********************************/

    function listar_cliente_hogar_individual($idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_BAYER_PERSONAS(:id_categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE CLIENTES HOGAR INDIVIDUAL ASIGNADOS
     ***********************************/

    function listar_cliente_hogar_individual_asignados($idUsuario, $idCategoria)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_BAYER_PERSONAS_ASIGNADOS(:id_usuario,:id_categoria)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    function listar_hogares_individual($idBayer, $idContrato)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_HOGARES_INDIVIDUAL(:idBayer,:idContrato)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idBayer', $idBayer, PDO::PARAM_INT);
        $stmt->bindParam(':idContrato', $idContrato, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE PROSPECTOS WEB CHAT
     ***********************************/

    function listar_cliente_contrato_existe($idCliente)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CONTAR_CLIENTE_EXISTE(:id_cliente)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_STR);
        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
}
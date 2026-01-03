<?php
require_once 'modelo_conexion.php';

class Modelo_Usuario extends conexionBD
{

    /********************************************
     *******CONSULTAR USUARIO Y VERIFICAR LOGIN
     ********************************************/
    public function VerificarUsuario($usuario, $password)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_VERIFICAR_USUARIO(:usuario)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        $arreglo = array();

        foreach ($respuesta as $value) {
            if (password_verify($password, $value["usuario_password"])) {
                $arreglo[] = $value;
            }
        }
        return $arreglo;
        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR ULTIMO LOGIN USUARIO
     ***********************************/
    function Registrar_Usuario_Ultimo_Login($idusuario, $fechaActual)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_ULTIMO_LOGIN_USUARIO(:id_usuario,:usuario_ultimo_login)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idusuario, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_ultimo_login', $fechaActual, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE USUARIOS
     ***********************************/

    function listar_usuario()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_USUARIO()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE VENDEDORES
     ***********************************/

    function listar_asignar_vendedor()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_ASIGNAR_VENDEDOR()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CONSULTAR LISTA DE EMPLEADOS
     ***********************************/
    function listar_combo_empleado()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_COMBO_EMPLEADO()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }
    /***********************************
     *******CONSULTAR LISTA DE ROLES
     ***********************************/
    function listar_combo_rol()
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_LISTAR_COMBO_ROL()';

        $stmt = $c->prepare($sql);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }


    /***********************************
     *******MODIFICAR ESTATUS USUARIO
     ***********************************/
    function Modificar_Estatus_Usuario($idusuario, $estatus)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_ESTATUS_USUARIO(:id_usuario,:estatus)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idusuario, PDO::PARAM_STR);
        $stmt->bindParam(':estatus', $estatus, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******CREAR NUEVO REGRISTRO USUARIO
     ***********************************/
    function Registrar_Usuario($usuario, $contra, $empleado, $email, $rol, $fechaActual)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CREAR_USUARIO(:usuario,:contra,:empleado,:email,:rol,:fechaActual)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':empleado', $empleado, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        foreach ($respuesta as $value) {

            return $value;
            conexionBD::cerrar_conexion();
        }
    }

    /***********************************
     *******MODIFICAR DATOS USUARIO
     ***********************************/
    function Modificar_Datos_Usuario($idUsuario, $usuario, $contra, $empleado, $email, $rol)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_DATOS_USUARIO(:id_usuario,:usuario,:contra,:empleado,:email,:rol)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':empleado', $empleado, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }
    /***********************************
     *******CONSULTAR UNICO USUARIO
     ***********************************/

    function TraerDatosUsuario($idusuario)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_USUARIO(:id_usuario)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idusuario, PDO::PARAM_INT);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******MODIFICAR ESTATUS USUARIO
     ***********************************/
    function Modificar_Password_Cliente($idCliente, $cedula, $contra, $fechaActual, $fecha_caduca)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_RESET_PASSWORD_USUARIO_CLIENTE(:idCliente,:cedula,:contra,:fechaActual,:fecha_caduca)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_caduca', $fecha_caduca, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }

    /***********************************
     *******RESETEAR CONTRASEÑA USUARIO
     ***********************************/
    function Reset_Password_Usuario($cedula, $contra, $fecha_caduca)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_RESET_PASSWORD_USUARIO(:cedula,:contra,:fecha_caduca)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_caduca', $fecha_caduca, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /***********************************
     *******MODIFICAR DATOS USUARIO
     ***********************************/
    function Update_Password_Usuario($idUsuario, $contra, $fecha_caduca)
    {

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_ACTUALIZAR_PASSWORD_USUARIO(:id_usuario,:contra,:fecha_caduca)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_caduca', $fecha_caduca, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        };

        conexionBD::cerrar_conexion();
    }
}

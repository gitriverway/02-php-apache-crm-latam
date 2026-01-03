<?php
    require_once 'modelo_conexion.php';

    class Modelo_Empleado  extends conexionBD{
        /***********************************
         *******CONSULTAR LISTA DE EMPLEADOS
        ***********************************/

        function listar_empleado(){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_EMPLEADO()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        
/***********************************
 *******MODIFICAR ESTATUS EMPLEADO
***********************************/
    function Modificar_Estatus_Empleado($idEmpleado,$estatus){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_ESTATUS_EMPLEADO(:id_empleado,:estatus)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_STR);
        $stmt->bindParam(':estatus', $estatus, PDO::PARAM_STR);

        if ($stmt->execute()) {
                return 1;
            }else{
                return 0;
            };
        
            conexionBD::cerrar_conexion();

    }

    /***********************************
     *******CREAR NUEVO REGRISTRO EMPLEADO
    ***********************************/
    function Registrar_Empleado($nombre,$apellido,$provincia,$direccion,$fechaActual){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CREAR_EMPLEADO(:nombre,:apellido,:provincia,:direccion,:fechaActual)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':provincia', $provincia, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

        $stmt->execute();
        
        $respuesta=$stmt -> fetchAll();

            foreach ($respuesta as $value) {
                
                    return $value;
                    conexionBD::cerrar_conexion();
            }

    }

       /***********************************
 *******CONSULTAR UNICO EMPLEADO
***********************************/

    function TraerDatosEmpleado($idEmpleado){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_EMPLEADO(:id_empleado)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_INT);

        $stmt->execute();
        
        $respuesta=$stmt -> fetchAll();

        return $respuesta;
        
        conexionBD::cerrar_conexion();

    }

      /***********************************
 *******MODIFICAR DATOS EMPLEADO
***********************************/
function Modificar_Datos_Empleado($idEmpleado,$nombre,$apellido,$provincia,$direccion){

    $c = conexionBD::conexionPDO();

    $sql = 'CALL SP_MODIFICAR_DATOS_EMPLEADO(:id_empleado,:nombre,:apellido,:provincia,:direccion)';

    $stmt = $c->prepare($sql);

    $stmt->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $stmt->bindParam(':provincia', $provincia, PDO::PARAM_STR);
    $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);

    $stmt->execute();

    $respuesta=$stmt -> fetchAll();

            foreach ($respuesta as $value) {
                
                    return $value;
                    conexionBD::cerrar_conexion();
            }

    conexionBD::cerrar_conexion();
}


        /***********************************
         *******CONSULTAR LISTA DE EMPELADOS SELECCIONAR
        ***********************************/

        function listar_empleados_seleccionar(){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_EMPLEADOS_SELECCIONAR()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }
}
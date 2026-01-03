<?php
    require_once 'modelo_conexion.php';

    class Modelo_Prospecto_Web  extends conexionBD{

        /***********************************
         *******CONSULTAR LISTA DE PROSPECTOS WEB
        ***********************************/

        function listar_prospecto_web(){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_LISTAR_PROSPECTOS_WEB()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

    /***********************************
     *******MODIFICAR VENDEDOR ASIGNADO A PROSPECTO
    ***********************************/
        function Modificar_Vendedor_Asigando_Prospecto_Web($idProspecto,$idEmpleado){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_MODIFICAR_VENDEDOR_ASIGANDO_PROSPECTO_WEB(:id_prospecto,:id_empleado)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);
            $stmt->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_STR);

            if ($stmt->execute()) {
                    return 1;
                }else{
                    return 0;
                };
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
     *******ELIMINAR PROSPECTO WEB y CLIENTE
    ***********************************/
    function Eliminar_Prospecto_Web($idProspecto){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_ELIMINAR_PROSPECTO_WEB(:id_prospecto)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);

        if ($stmt->execute()) {
                return 1;
            }else{
                return 0;
            };
        
        conexionBD::cerrar_conexion();

    }

    /***********************************
         *******CONSULTAR LISTA DE PROSPECTOS WEB CHAT
        ***********************************/

        function listar_prospecto_web_chat($idProspecto){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_LISTAR_PROSPECTOS_WEB_CHAT(:id_prospecto)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_prospecto', $idProspecto, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }
}
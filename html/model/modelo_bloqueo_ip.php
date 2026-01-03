<?php
    require_once 'modelo_conexion.php';

    class Modelo_Bloqueo_Ip  extends conexionBD{

        /***********************************
         *******CONSULTAR LISTA DE BLOQUEO IP
        ***********************************/

        function listar_bloqueo_ip(){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_LISTAR_BLOQUEO_IP()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

    /***********************************
     *******MODIFICAR ESTADO BLOQUEO IP
    ***********************************/
        function Modificar_Estado_Bloqueo_Ip($idBloqueo,$estado){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_MODIFICAR_ESTADO_BLOQUEO_IP(:id_bloqueo,:estado)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_bloqueo', $idBloqueo, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

            if ($stmt->execute()) {
                    return 1;
                }else{
                    return 0;
                };
            
            conexionBD::cerrar_conexion();

        }
}
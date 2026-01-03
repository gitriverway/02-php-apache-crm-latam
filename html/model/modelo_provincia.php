<?php
    require_once 'modelo_conexion.php';

    class Modelo_Provincia  extends conexionBD{

        /***********************************
         *******CONSULTAR COMBO LISTA DE PROVINCIAS
        ***********************************/
        function listar_combo_provincia(){
            
            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_COMBO_PROVINCIA()';
        
            $stmt = $c->prepare($sql);
        
            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();
        
            return $respuesta;
            
            conexionBD::cerrar_conexion();
        
        }
    }
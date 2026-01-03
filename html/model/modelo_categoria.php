<?php
    require_once 'modelo_conexion.php';

    class Modelo_Categoria  extends conexionBD{

        /***********************************
         *******CONSULTAR COMBO LISTA DE CATEGORIA
        ***********************************/
        function listar_combo_categoria($tipo){
            
            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_COMBO_CATEGORIA(:tipo)';
        
            $stmt = $c->prepare($sql);

            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        
            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();
        
            return $respuesta;
            
            conexionBD::cerrar_conexion();
        
        }
    }
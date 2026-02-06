<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require_once 'modelo_conexion.php';

    class Modelo_Ciudad extends conexionBD{

        /***********************************
         *******CONSULTAR COMBO LISTA DE CIUDADES
        ***********************************/
        function listar_combo_ciudad($idProvincia){
            
            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_COMBO_CIUDAD_PROVINCIA(:provincia_id)';
        
            $stmt = $c->prepare($sql);

            $stmt->bindParam(':provincia_id', $idProvincia, PDO::PARAM_STR);
        
            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();
        
            return $respuesta;
            
            conexionBD::cerrar_conexion();
        
        }
    }
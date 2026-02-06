<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require_once 'modelo_conexion.php';

    class Modelo_Reporte extends conexionBD{


        /***********************************
         *******CONSULTAR DESCARAGRA BAYER PERSONA
        ***********************************/

            function descargar_bayer_persona(){

                $c = conexionBD::conexionPDO();

                $sql = 'CALL SP_REPORTE_DESCAGAR_BAYERPERSONA()';

                $stmt = $c->prepare($sql);

                $stmt->execute();
                
                $respuesta=$stmt -> fetchAll();

                return $respuesta;
                
                conexionBD::cerrar_conexion();

            }

    }
?>
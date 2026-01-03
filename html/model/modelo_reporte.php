<?php
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
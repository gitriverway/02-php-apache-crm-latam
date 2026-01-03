<?php
    require_once 'modelo_conexion.php';

    class Modelo_Credito_Ambulatorio_Observacion_Empresarial extends conexionBD{

        /***********************************
     *******MODIFICAR OBSERVACIONES PEDIDO OPERATORIO CLIENTE
    ***********************************/
    function Modificar_Observaciones_Adicionales_Seguimiento_Credito_Ambulatorio($idOperatorio,$lista_observaciones_adicionales,$fecha_seguimiento,$fechaActual,$fechaActual1){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_OBSERVACION_PYMES(:idOperatorio,:lista_observaciones_adicionales,:fecha_seguimiento,:fechaActual,:fechaActual1)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':lista_observaciones_adicionales', $lista_observaciones_adicionales, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        if ($stmt->execute()) {
                return 1;
            }else{
                return 0;
            };
        
        conexionBD::cerrar_conexion();

    }

        /***********************************
     *******MODIFICAR OBSERVACIONES PEDIDO OPERATORIO CLIENTE
    ***********************************/
    function Modificar_Observaciones_Anulacion_Credito_Ambulatorio($idOperatorio,$lista_observaciones_anulacion,$fechaActual,$fechaActual1){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_MODIFICAR_CREDITO_AMBULATORIO_ANULACION_OBSERVACION_PYMES(:idOperatorio,:lista_observaciones_anulacion,:fechaActual,:fechaActual1)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':idOperatorio', $idOperatorio, PDO::PARAM_STR);
        $stmt->bindParam(':lista_observaciones_anulacion', $lista_observaciones_anulacion, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual1', $fechaActual1, PDO::PARAM_STR);

        if ($stmt->execute()) {
                return 1;
            }else{
                return 0;
            };
        
        conexionBD::cerrar_conexion();

    }

    }
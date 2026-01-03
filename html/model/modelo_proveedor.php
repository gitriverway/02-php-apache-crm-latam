<?php
    require_once 'modelo_conexion.php';

    class Modelo_Proveedor  extends conexionBD{

        /***********************************
         *******CONSULTAR COMBO LISTA DE PROVINCIAS
        ***********************************/
        function listar_proveedor(){
            
            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_PROVEEDORES()';
        
            $stmt = $c->prepare($sql);
        
            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();
        
            return $respuesta;
            
            conexionBD::cerrar_conexion();
        
        }

        /***********************************
         *******CONSULTAR COMBO LISTA DE PROVINCIAS
        ***********************************/
        function listar_combo_proveedor(){
            
            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_COMBO_PROVEEDOR()';
        
            $stmt = $c->prepare($sql);
        
            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();
        
            return $respuesta;
            
            conexionBD::cerrar_conexion();
        
        }

        function listar_planes_por_proveedor($idProveedor){
            
            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_UNICO_PROVEEDOR(:proveedor_id)';
        
            $stmt = $c->prepare($sql);

            $stmt->bindParam(':proveedor_id', $idProveedor, PDO::PARAM_STR);
        
            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();
        
            return $respuesta;
            
            conexionBD::cerrar_conexion();
        
        }

        
    /***********************************
     *******CREAR NUEVO REGRISTRO PROVEEDOR
    ***********************************/
    function Registrar_Proveedor($nombre,$direccion,$listaCorreoReembolsos,$listaCorreoSiniestros,$listaCorreoOperatorios,$listaCorreoCreditoAmbulatorio,$listaCorreoSiniestrosHogar,$fechaActual){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_CREAR_PROVEEDOR(:nombre,:direccion,:listaCorreoReembolsos,:listaCorreoSiniestros,:listaCorreoOperatorios,:listaCorreoCreditoAmbulatorio,:listaCorreoSiniestrosHogar,:fechaActual)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':listaCorreoReembolsos', $listaCorreoReembolsos, PDO::PARAM_STR);
        $stmt->bindParam(':listaCorreoSiniestros', $listaCorreoSiniestros, PDO::PARAM_STR);
        $stmt->bindParam(':listaCorreoOperatorios', $listaCorreoOperatorios, PDO::PARAM_STR);
        $stmt->bindParam(':listaCorreoCreditoAmbulatorio', $listaCorreoCreditoAmbulatorio, PDO::PARAM_STR);
        $stmt->bindParam(':listaCorreoSiniestrosHogar', $listaCorreoSiniestrosHogar, PDO::PARAM_STR);
        $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

        $stmt->execute();
        
        $respuesta=$stmt -> fetchAll();

            foreach ($respuesta as $value) {
                
                    return $value;
                    conexionBD::cerrar_conexion();
            }

    }

       /***********************************
 *******CONSULTAR UNICO PROVEEDOR
***********************************/

    function TraerDatosProveedor($idProveedor){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_UNICO_PROVEEDOR(:id_proveedor)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_proveedor', $idProveedor, PDO::PARAM_INT);

        $stmt->execute();
        
        $respuesta=$stmt -> fetchAll();

        return $respuesta;
        
        conexionBD::cerrar_conexion();

    }

      /***********************************
     *******MODIFICAR DATOS PROVEEDOR
    ***********************************/
function Modificar_Datos_Proveedor($idProveedor,$nombre,$direccion,$listaCorreoReembolsos,$listaCorreoSiniestros,$listaCorreoOperatorios,$listaCorreoCreditoAmbulatorio,$listaCorreoSiniestroHogar,$fechaActual){

    $c = conexionBD::conexionPDO();

    $sql = 'CALL SP_MODIFICAR_DATOS_PROVEEDOR(:idProveedor,:nombre,:direccion,:listaCorreoReembolsos,:listaCorreoSiniestros,:listaCorreoOperatorios,:listaCorreoCreditoAmbulatorio,:listaCorreoSiniestroHogar,:fechaActual)';

    $stmt = $c->prepare($sql);

    $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
    $stmt->bindParam(':listaCorreoReembolsos', $listaCorreoReembolsos, PDO::PARAM_STR);
    $stmt->bindParam(':listaCorreoSiniestros', $listaCorreoSiniestros, PDO::PARAM_STR);
    $stmt->bindParam(':listaCorreoOperatorios', $listaCorreoOperatorios, PDO::PARAM_STR);
    $stmt->bindParam(':listaCorreoCreditoAmbulatorio', $listaCorreoCreditoAmbulatorio, PDO::PARAM_STR);
    $stmt->bindParam(':listaCorreoSiniestroHogar', $listaCorreoSiniestroHogar, PDO::PARAM_STR);
    $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

    $stmt->execute();

    $respuesta=$stmt -> fetchAll();

            foreach ($respuesta as $value) {
                
                    return $value;
                    conexionBD::cerrar_conexion();
            }

    conexionBD::cerrar_conexion();
}
    }
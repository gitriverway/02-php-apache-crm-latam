<?php
    require_once 'modelo_conexion.php';

    class Modelo_Factura_Cliente  extends conexionBD{

        /***********************************
         *******CONSULTAR LISTA DE FACTURAS de CLIENTES
        ***********************************/

        function listar_factura_cliente(){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_LISTAR_FACTURAS_CLIENTES()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        function listar_factura_cliente_cedula($idUsuario){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_LISTAR_FACTURAS_CLIENTES_CEDULA(:usuario_id)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':usuario_id', $idUsuario, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CREAR NUEVO REGRISTRO FACTURA CLIENTE
        ***********************************/
        function Registrar_factura_cliente($cedula,$nombre,$numero_factura,$fecha_emision,$valor_factura,$forma_pago,$nuevoNombreArchivo,$fechaActual){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_CREAR_FACTURA_CLIENTE(:cedula,:nombre,:numero_factura,:fecha_emision,:valor_factura,:forma_pago,:nuevoNombreArchivo,:fechaActual)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':numero_factura', $numero_factura, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_emision', $fecha_emision, PDO::PARAM_STR);
            $stmt->bindParam(':valor_factura', $valor_factura, PDO::PARAM_STR);
            $stmt->bindParam(':forma_pago', $forma_pago, PDO::PARAM_STR);
            $stmt->bindParam(':nuevoNombreArchivo', $nuevoNombreArchivo, PDO::PARAM_STR);
            $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            $arreglo = array();

                foreach ($respuesta as $value) {

                    $arreglo[] = $value;

                }
            return $arreglo;

            conexionBD::cerrar_conexion();

        }

        /***********************************
     *******ELIMINAR FACTURA
    ***********************************/
    function Eliminar_factura_cliente($idFactura){

        $c = conexionBD::conexionPDO();

        $sql = 'CALL SP_ELIMINAR_FACTURA_CLIENTE(:id_factura)';

        $stmt = $c->prepare($sql);

        $stmt->bindParam(':id_factura', $idFactura, PDO::PARAM_STR);

        if ($stmt->execute()) {
                return 1;
            }else{
                return 0;
            };
        
        conexionBD::cerrar_conexion();

    }
    }
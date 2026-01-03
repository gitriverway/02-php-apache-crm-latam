<?php
    require_once 'modelo_conexion.php';

    class Modelo_Cliente  extends conexionBD{

        /***********************************
         *******CONSULTAR LISTA DE CLIENTES VIDA INDIVIDUAL
        ***********************************/

        function listar_cliente_vida_individual($idCategoria){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_CLIENTES(:id_categoria)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CONSULTAR LISTA DE CLIENTES VEHICULO INDIVIDUAL
        ***********************************/

        function listar_cliente_vehiculo_individual($idCategoria){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_CLIENTES(:id_categoria)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CONSULTAR LISTA DE CLIENTES VIDA INDIVIDUAL ASIGNADOS
        ***********************************/

        function listar_cliente_vida_individual_asignados($idUsuario,$idCategoria){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_CLIENTES_ASIGNADOS(:id_usuario,:id_categoria)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CONSULTAR LISTA DE CLIENTES VEHICULOS INDIVIDUAL ASIGNADOS
        ***********************************/

        function listar_cliente_vehiculo_individual_asignados($idUsuario,$idCategoria){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_CLIENTES_ASIGNADOS(:id_usuario,:id_categoria)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }


    /***********************************
     *******MODIFICAR VENDEDOR ASIGNADO A CLIENTE
    ***********************************/
        function Modificar_Vendedor_Asigando_Cliente($idCliente,$idEmpleado){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_MODIFICAR_VENDEDOR_ASIGANDO_CLIENTE(:id_cliente,:id_empleado)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_STR);
            $stmt->bindParam(':id_empleado', $idEmpleado, PDO::PARAM_STR);

            if ($stmt->execute()) {
                    return 1;
                }else{
                    return 0;
                };
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
 *******MODIFICAR ESADO BAYER DE CLIENTE
***********************************/
        function Modificar_Esado_Bayer_Cliente($idCliente,$estadoBayer){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_MODIFICAR_ESTADO_BAYER_CLIENTE(:id_cliente,:estado_bayer)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_STR);
            $stmt->bindParam(':estado_bayer', $estadoBayer, PDO::PARAM_STR);

            if ($stmt->execute()) {
                    return 1;
                }else{
                    return 0;
                };
            
                conexionBD::cerrar_conexion();

        }

        

        /***********************************
         *******CONSULTAR UNICO CLIENTE
        ***********************************/

        function TraerDatosCliente($idcliente){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_UNICO_CLIENTE(:idcliente)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        function listar_observacion_cliente($idCliente){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_OBSERVACIONES_CLIENTES(:id_cliente)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******MODIFICAR CLIENTE
        ***********************************/
        function Modificar_Cliente($idCliente,$origen,$categoria,$cedula,$nombre,$fecha_nacimiento,$genero,$telefono,$email,$provincia,$ciudad,$direccion,$ocupacion,$valor_ingreso,$valor_asegurado,$prima_neta_anual,$tipo_pago,$forma_pago,$listaFamiliares,$idUsuario,$estado_bayer,$idProducto,$fechaActual,$proveedor,$numero_contrato,$fecha_emision,$fecha_fin,$valor_contrato,$contra,$fecha_seguimiento,$listaVehiculos,$listaObservaciones){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_MODIFICAR_CLIENTE(:idCliente,:origen,:categoria,:cedula,:nombre,:fecha_nacimiento,:genero,:telefono,:email,:provincia,:ciudad,:direccion,:ocupacion,:valor_ingreso,:valor_asegurado,:prima_neta_anual,:tipo_pago,:forma_pago,:lista_familia,:idUsuario,:estado_bayer,:idProducto,:fecha_actual,:proveedor,:numero_contrato,:fecha_emision,:fecha_fin,:valor_contrato,:contra,:fecha_seguimiento,:listaVehiculos,:listaObservaciones)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
            $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':provincia', $provincia, PDO::PARAM_STR);
            $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
            $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
            $stmt->bindParam(':ocupacion', $ocupacion, PDO::PARAM_STR);
            $stmt->bindParam(':valor_ingreso', $valor_ingreso, PDO::PARAM_STR);
            $stmt->bindParam(':valor_asegurado', $valor_asegurado, PDO::PARAM_STR);
            $stmt->bindParam(':prima_neta_anual', $prima_neta_anual, PDO::PARAM_STR);
            $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
            $stmt->bindParam(':forma_pago', $forma_pago, PDO::PARAM_STR);
            $stmt->bindParam(':lista_familia', $listaFamiliares, PDO::PARAM_STR);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
            $stmt->bindParam(':estado_bayer', $estado_bayer, PDO::PARAM_STR);
            $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_actual', $fechaActual, PDO::PARAM_STR);
            $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);

            $stmt->bindParam(':numero_contrato', $numero_contrato, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_emision', $fecha_emision, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
            $stmt->bindParam(':valor_contrato', $valor_contrato, PDO::PARAM_STR);

            $stmt->bindParam(':contra', $contra, PDO::PARAM_STR);

            $stmt->bindParam(':fecha_seguimiento', $fecha_seguimiento, PDO::PARAM_STR);
            $stmt->bindParam(':listaVehiculos', $listaVehiculos, PDO::PARAM_STR);
            $stmt->bindParam(':listaObservaciones', $listaObservaciones, PDO::PARAM_STR);

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
         *******ELIMNAR CLIENTE
        ***********************************/
        function Eliminar_Cliente($idProspecto){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_ELIMINAR_CLIENTE(:prospecto_id)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':prospecto_id', $idProspecto, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            $arreglo = array();

                foreach ($respuesta as $value) {

                    $arreglo[] = $value;

                }
            return $arreglo;

            conexionBD::cerrar_conexion();

        }

    }
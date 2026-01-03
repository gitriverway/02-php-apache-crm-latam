<?php
    require_once 'modelo_conexion.php';

    class Modelo_Cliente  extends conexionBD{
     
        /***********************************
         *******CONSULTAR LISTA DE CLIENTES
        ***********************************/

        function listar_clientes(){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_CLIENTES()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CONSULTAR LISTA DE CLIENTES SELECCIONAR
        ***********************************/

        function listar_cliente_seleccionar(){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_LISTAR_CLIENTES_SELECCIONAR()';

            $stmt = $c->prepare($sql);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
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

        
        /***********************************
         *******CONSULTAR UNICO USUARIO CLIENTE
        ***********************************/

        function TraerDatosUsuarioCliente($cedula){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_UNICO_USUARIO_CLIENTE(:cedula)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******MODIFICAR CLIENTE
        ***********************************/
        function Modificar_Cliente($idCliente,$cedula,$nombre,$fecha_nacimiento,$genero,$telefono,$email,$provincia,$ciudad,$direccion,$ocupacion,$valor_ingreso){

            $c = conexionBD::conexionPDO();
            
            $sql = 'CALL SP_MODIFICAR_CLIENTE(:idCliente,:cedula,:nombre,:fecha_nacimiento,:genero,:telefono,:email,:provincia,:ciudad,:direccion,:ocupacion,:valor_ingreso)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
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

        function TraerDatosClienteCedula($cedula){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_UNICO_CLIENTE_CEDULA(:cedula)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

        /***********************************
         *******CONSULTAR CONTAR CONTRATOS CLIENTE
        ***********************************/

        function listar_contar_clientes($idUsuario){

            $c = conexionBD::conexionPDO();

            $sql = 'CALL SP_UNICO_CONTAR_CONTRATO_CLIENTE(:idUsuario)';

            $stmt = $c->prepare($sql);

            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            $stmt->execute();
            
            $respuesta=$stmt -> fetchAll();

            return $respuesta;
            
            conexionBD::cerrar_conexion();

        }

    }
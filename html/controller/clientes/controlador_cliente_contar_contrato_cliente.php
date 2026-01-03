<?php
    require 'model/modelo_cliente.php';

    class Listar_clientes{

        function mostrar_contar_lista_clientes(){

            // session_start();

            if (isset($_SESSION['S_IDUSUARIO'])) {
                $idUsuario = $_SESSION['S_IDUSUARIO'];
            }else {
                $idUsuario = 0;
            }


            $MU = new Modelo_Cliente();

            $consulta = $MU->listar_contar_clientes($idUsuario);
            
            return $consulta;            

        }

    }


/*=============================================
LISTAR TABLA CLIENTES
=============================================*/
$listaUsuario = new Listar_clientes();
$listaUsuario -> mostrar_contar_lista_clientes();
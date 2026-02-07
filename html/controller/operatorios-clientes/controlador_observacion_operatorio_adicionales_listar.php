<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};

    require '../../model/modelo_operatorio_cliente.php';

    class Lista_observacion_operatorios{

        function mostrar_lista_observacion_operatorio(){

            $idOperatorio = htmlspecialchars($_POST['idOperatorio'],ENT_QUOTES,'UTF-8');

            $MU = new Modelo_Operatorio_Cliente();

            $consulta = $MU->listar_observacion_operatorios($idOperatorio);

            echo json_encode($consulta);
        }

    }


/*=============================================
LISTAS TABLA DE OBSERVACIONES PROPECTOS
=============================================*/
$listaUsuario = new Lista_observacion_operatorios();
$listaUsuario -> mostrar_lista_observacion_operatorio();
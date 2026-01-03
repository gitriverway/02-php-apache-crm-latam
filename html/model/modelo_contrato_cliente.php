<?php
require_once 'modelo_conexion.php';

class Modelo_Contrato_Cliente  extends conexionBD
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = parent::conexionPDO();
    }


    /***********************************
     *******CONSULTAR LISTA DE CONTRATOS de CLIENTES
     ***********************************/

    function listar_contrato_cliente($idCliente, $idCategoria, $estado)
    {

        $sql = 'CALL SP_LISTAR_CONTRATOS_CLIENTES(:cliente_id,:categoria_id,:estado)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':cliente_id', $idCliente, PDO::PARAM_STR);

        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);

        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /*********************************** 
     *******CONSULTAR LISTA DE CONTRATOS de CLIENTES SELECCIONADO
     ***********************************/

    function listar_contrato_cliente_seleccionado($idCliente, $idCategoria, $fecha)
    {
        $sql = 'CALL SP_LISTAR_CONTRATOS_CLIENTES_SELECCIONADO(:cliente_id,:categoria_id,:fecha)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':cliente_id', $idCliente, PDO::PARAM_STR);
        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    function listar_contrato_cliente_todos($idCategoria, $fecha)
    {
        $sql = 'CALL SP_LISTAR_CONTRATOS_CLIENTES_TODOS(:categoria_id,:fecha)';

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':categoria_id', $idCategoria, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }

    /***********************************
     *******CONSULTAR LISTA DE CONTRATOS de CLIENTES
     ***********************************/

    function listar_contrato_cliente_bayerpersona($idBayer)
    {

        $sql = 'CALL SP_LISTAR_CONTRATOS_CLIENTES_BAYER(:bayer_id)';

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':bayer_id', $idBayer, PDO::PARAM_STR);

        $stmt->execute();

        $respuesta = $stmt->fetchAll();

        return $respuesta;
    }
}
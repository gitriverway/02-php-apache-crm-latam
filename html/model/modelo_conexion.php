<?php
/* Conectar a una base de datos de MySQL invocando al controlador */

class conexionBD
{

    private $pdo;

    public function conexionPDO()
    {

        // $host = "localhost";
        // $usuario = "root";
        // $contrasena = "";
        // $puerto = "3306";
        // $dbname = "tailwind";

        $host = "72.61.79.47";
        $usuario = "latam";
        $contrasena = "HS5pWcQ6aWKZHY";
        $puerto = "3306";
        $dbname = "crmlatam";

        try {

            $pdo = new PDO("mysql:host=$host;port=$puerto;dbname=$dbname;", $usuario, $contrasena);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $this->pdo = $pdo;
            return $pdo;
        } catch (PDOException $e) {
            echo 'La conexión ha fallado';
        }
    }

    function cerrar_conexion()
    {
        $this->pdo = null;
    }
}
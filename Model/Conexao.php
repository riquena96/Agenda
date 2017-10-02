<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 27/09/2017
 * Time: 23:18
 */

//namespace CrudAgenda\Model;

class Conexao {

    function __construct()
    {
        $this->conectar();
    }

    public $conexaoMysql;

    public function conectar ()
    {
        $teste = true;

        if ($_SERVER['REMOTE_ADDR'] == "::1") {
            $teste = true;
        }

        $dsn = 'mysql:host=localhost;dbname=crudAgenda';
        $user = 'root';
        $password = '';

        if ($teste) {
            $dsn = 'mysql:host=localhost;dbname=crudAgenda';
            $user = 'root';
            $password = '';
        }

        try {
            $conn = new PDO($dsn, $user, $password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->conexaoMysql = $conn;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }

    }

}
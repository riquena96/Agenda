<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 28/09/2017
 * Time: 00:19
 */

//namespace CrudAgenda\Model;

include_once("Conexao.php");
include_once("../Controller/erro_log.php");

class Usuario extends Conexao
{

    function __construct()
    {
        $this->conectar();
    }

    public function novoUsuario ($nome)
    {

        try {
            $novoUsuario = $this->conexaoMysql->prepare('CALL criaUsuario (?)');
            $novoUsuario->bindValue(1, $nome, PDO::PARAM_STR);
            $novoUsuario->execute();

            return json_encode("Usuário Cadastrado como Sucesso!");
        } catch (\PDOException $exception) {
            return json_encode("Ocorreu um erro ao adicionar o Usuário, tente novamente, caso o erro persista, contate o suporte!");
        }

    }

    public function alteraUsuario ($idUsuario, $nome)
    {

        try {
            $alteraUsuario = $this->conexaoMysql->prepare('CALL alteraUsuario(?,?)');
            $alteraUsuario->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $alteraUsuario->bindValue(2, $nome, PDO::PARAM_STR);
            $alteraUsuario->execute();

            return json_encode("Usuário Alterado com Sucesso!");
        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao alterar o e-mail!';
        }

    }

    public function listaUsuario ()
    {

        try {
            $queryFindAllUsuario = $this->conexaoMysql->prepare('CALL listaUsuario()');
            $queryFindAllUsuario->execute();

            $listaUsuario = array();

            while ($row = $queryFindAllUsuario->fetch(PDO::FETCH_ASSOC)) {

                $listaUsuario[] = array(
                    'idUsuario' => $row['idUsuario'],
                    'nome' => utf8_encode($row['nome'])
                );
            }

            return json_encode(array('data' => $listaUsuario));

        } catch (\PDOException $exception) {

        }

    }

    public function listaByIdUsuario ($idUsuario)
    {

        try {
            $queryFindByIdUsuario = $this->conexaoMysql->prepare('CALL listaByIdUsuario(?)');
            $queryFindByIdUsuario->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $queryFindByIdUsuario->execute();

            $listaByIdUsuario = array();

            while ($row = $queryFindByIdUsuario->fetch(PDO::FETCH_ASSOC)) {

                $listaByIdUsuario [] = array(

                    //'idUsuario' => $row['idUsuario'],
                    'nome' => utf8_encode($row['nome'])

                );

            }

            return json_encode(array('data' => $listaByIdUsuario));

        } catch (\PDOException $exception) {

        }

    }

    public function excluiUsuario ($idUsuario)
    {

        try {

            $excluiUsuario = $this->conexaoMysql->prepare('CALL excluiUsuario(?)');
            $excluiUsuario->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $excluiUsuario->execute();

            return json_encode("Usuário Excluído como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao excluir o e-mail!';
        }

    }

    public function totalUsuario()
    {

        try {
            $totalUsuario = $this->conexaoMysql->prepare('CALL totalUsuario()');
            $totalUsuario->execute();

            $total = array();

            while ($row = $totalUsuario->fetch(PDO::FETCH_ASSOC)) {

                $total [] = array(

                    'total' => $row['total']

                );

            }

            return json_encode(array('data' => $total));

        } catch (\PDOException $exception) {
            die ($exception->getMessage());
        }

    }

}
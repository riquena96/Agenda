<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 28/09/2017
 * Time: 08:44
 */

//namespace CrudAgenda\Model;

include_once ("Conexao.php");
include_once ("./../Controller/erro_log.php");

class Email extends Conexao
{

    function __construct()
    {
        $this->conectar();
    }

    public function novoEmail($idUsuario, $email)
    {

        try {

            $novoEmail = $this->conexaoMysql->prepare('CALL novoEmail(?,?)');
            $novoEmail->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $novoEmail->bindValue(2, $email, PDO::PARAM_STR);
            $novoEmail->execute();

            return json_encode("E-mail Cadastrado como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'E-mail já cadastrado!';
        }

    }

    public function alteraEmail($idEmail, $email)
    {

        try {

            $alteraEmail = $this->conexaoMysql->prepare('CALL alteraEmail(?,?)');
            $alteraEmail->bindValue(1, $idEmail, PDO::PARAM_INT);
            $alteraEmail->bindValue(2, $email, PDO::PARAM_STR);
            $alteraEmail->execute();

            return json_encode("E-mail alterado como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao alterar o e-mail!';
        }

    }

    public function listaEmail()
    {

        try {

            $queryBuscaEmail = $this->conexaoMysql->prepare('CALL listaEmail()');
            $queryBuscaEmail->execute();

            $listaEmail = array();

            while ($row = $queryBuscaEmail->fetch(PDO::FETCH_ASSOC)) {

                $listaEmail [] = array(
                    'idEmailUsuario' => $row['idEmailUsuario'],
                    'idUsuario' => $row['idUsuario'],
                    'email' => $row['email']
                );

            }

            return json_encode(array('data' => $listaEmail));

        } catch (\PDOException $exception) {

        }

    }

    public function listaEmailByIdEmail($idEmail)
    {

        try {

            $buscaEmailByIdEmail = $this->conexaoMysql->prepare('CALL listaEmailByIdEmail(?)');
            $buscaEmailByIdEmail->bindValue(1, $idEmail, PDO::PARAM_INT);
            $buscaEmailByIdEmail->execute();

            $listaEmailByIdEmail = array();

            while ($row = $buscaEmailByIdEmail->fetch(PDO::FETCH_ASSOC)) {

                $listaEmailByIdEmail [] = array(

                    'idEmailUsuario' => $row['idEmailUsuario'],
                    'email' => $row['email']

                );

            }

            return json_encode(array('data' => $listaEmailByIdEmail));

        } catch (\PDOException $exception) {

        }

    }

    public function listaEmailByIdUsuario($idUsuario)
    {

        try {

            $buscaEmailByIdUsuario = $this->conexaoMysql->prepare('CALL listaEmailByIdUsuario(?)');
            $buscaEmailByIdUsuario->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $buscaEmailByIdUsuario->execute();

            $listaEmailByIdUsuario = array();

            while ($row = $buscaEmailByIdUsuario->fetch(PDO::FETCH_ASSOC)) {

                $listaEmailByIdUsuario [] = array(

                    'idEmailUsuario' => $row['idEmailUsuario'],
                    'email' => $row['email']

                );

            }

            return json_encode(array('data' => $listaEmailByIdUsuario));

        } catch (\PDOException $exception) {

        }

    }

    public function excluiEmail($idEmail)
    {

        try {

            $excluiEmail = $this->conexaoMysql->prepare('CALL excluiEmail(?)');
            $excluiEmail->bindValue(1, $idEmail, PDO::PARAM_INT);
            $excluiEmail->execute();

            return json_encode("E-mail Excluído como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao excluir o e-mail!';
        }

    }

    public function listaUltimosEmailsCadastrados()
    {

        try {

            $listaUltimosEmailsCadastrados = $this->conexaoMysql->prepare('CALL listaUltimosEmailsCadastrados()');
            $listaUltimosEmailsCadastrados->execute();

            $listaEmail = array();

            while ($row = $listaUltimosEmailsCadastrados->fetch(PDO::FETCH_ASSOC)) {

                $listaEmail [] = array(

                    'nome' => $row['nome'],
                    'email' => $row['email'],
                    'dataCriacao' => $row['dataCriacao']

                );

            }

            return json_encode(array('data' => $listaEmail));

        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function totalEmail()
    {

        try {
            $totalEmail = $this->conexaoMysql->prepare('CALL totalEmail()');
            $totalEmail->execute();

            $total = array();

            while ($row = $totalEmail->fetch(PDO::FETCH_ASSOC)) {

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
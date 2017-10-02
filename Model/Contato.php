<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 28/09/2017
 * Time: 09:04
 */

include_once ("Conexao.php");
include_once ("./../Controller/erro_log.php");

class Contato extends Conexao
{

    public function __construct()
    {
        $this->conectar();
    }

    public function novoContato ($idUsuario, $ddd, $telefone)
    {

        try {

            $novoContato = $this->conexaoMysql->prepare('CALL novoContato(?,?,?)');
            $novoContato->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $novoContato->bindValue(2, $ddd, PDO::PARAM_INT);
            $novoContato->bindValue(3, $telefone, PDO::PARAM_INT);
            $novoContato->execute();

            return json_encode("Contato Cadastrado como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao inserir o contato!';
        }

    }

    public function alteraContato ($idContato, $ddd, $telefone)
    {

        try {

            $alteraContato = $this->conexaoMysql->prepare('CALL alteraContato(?,?,?)');
            $alteraContato->bindValue(1, $idContato, PDO::PARAM_INT);
            $alteraContato->bindValue(2, $ddd, PDO::PARAM_INT);
            $alteraContato->bindValue(3, $telefone, PDO::PARAM_INT);
            $alteraContato->execute();

            return json_encode("Contato Alterado como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao alterar o contato!';
        }

    }

    public function listaContato ()
    {

        try {

            $queryListaContato = $this->conexaoMysql->prepare('CALL listaContato()');
            $queryListaContato->execute();

            $listaContato = array();

            while ($row = $queryListaContato->fetch(PDO::FETCH_ASSOC)) {

                $listaContato [] = array(
                    'idContatoUsuario' => $row['idContatoUsuario'],
                    'ddd' => $row['ddd'],
                    'telefone' => $row['telefone']
                );

            }

            return json_encode(array('data' => $listaContato));

        } catch (\PDOException $exception) {

        }

    }

    public function listaContatoByIdContato ($idContao)
    {

        try {

            $queryListaContatoByIdContato = $this->conexaoMysql->query('CALL listaContatoByIdContato(?)');
            $queryListaContatoByIdContato->bindValue(1, $idContao, PDO::PARAM_INT);
            $queryListaContatoByIdContato->execute();

            $listaContatoByIdContato = array();

            while ($row = $queryListaContatoByIdContato->fetch(PDO::FETCH_ASSOC)) {

                $listaContatoByIdContato [] = array(
                    'idContato' => $row['idContato'],
                    'ddd' => $row['ddd'],
                    'telefone' => $row['telefone']
                );

            }

            return json_encode(array('data' => $listaContatoByIdContato));

        } catch (\PDOException $exception) {

        }

    }

    public function listaContatoByIdUsuario ($idUsuario)
    {

        try {

            $queryListaContatoByIdUsuario = $this->conexaoMysql->prepare('CALL listaContatoByIdUsuario(?)');
            $queryListaContatoByIdUsuario->bindValue(1, $idUsuario, PDO::PARAM_INT);
            $queryListaContatoByIdUsuario->execute();

            $listaContatoByIdUsuario = array();

            while ($row = $queryListaContatoByIdUsuario->fetch(PDO::FETCH_ASSOC)) {

                $listaContatoByIdUsuario [] = array(
                    'idContatoUsuario' => $row['idContatoUsuario'],
                    'ddd' => $row['ddd'],
                    'telefone' => $row['telefone']
                );

            }

            return json_encode(array('data' => $listaContatoByIdUsuario));

        } catch (\PDOException $exception) {

        }

    }

    public function excluiContato ($idContato)
    {

        try {

            $excluiContato = $this->conexaoMysql->prepare('CALL excluiContato(?)');
            $excluiContato->bindValue(1, $idContato, PDO::PARAM_INT);
            $excluiContato->execute();

            return json_encode("Contato Excluído como Sucesso!");

        } catch (\PDOException $exception) {
            session_start();
            $_SESSION['mensagem'] = 'Ocorreu um erro ao excluir o contato!';
        }

    }

    public function listaUltimosContatosCadastrados()
    {

        try {

            $listaUltimosContatosCadastrados = $this->conexaoMysql->prepare('CALL listaUltimosContatosCadastrados()');
            $listaUltimosContatosCadastrados->execute();

            $listaContato = array();

            while ($row = $listaUltimosContatosCadastrados->fetch(PDO::FETCH_ASSOC)) {

                $listaContato [] = array(

                    'nome' => $row['nome'],
                    'telefone' => $row['telefone'],
                    'dataCriacao' => $row['dataCriacao']

                );

            }

            return json_encode(array('data' => $listaContato));

        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function totalContato()
    {

        try {
            $totalContato = $this->conexaoMysql->prepare('CALL totalContato()');
            $totalContato->execute();

            $total = array();

            while ($row = $totalContato->fetch(PDO::FETCH_ASSOC)) {

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
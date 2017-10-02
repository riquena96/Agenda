<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 28/09/2017
 * Time: 10:06
 */

//namespace CrudAgenda\Controller;

//use CrudAgenda\Model\Email;

include_once ("./../Model/Email.php");
include_once ("./../Model/erro_log.php");

$Email = new Email();

if (isset($_REQUEST)) {
    $action = strip_tags($_REQUEST['action']);
} else {
    $action = "";
}

switch ($action) {

    case 'novoEmail' :

        $idUsuario = strip_tags($_REQUEST['idUsuario']);
        $email = strip_tags($_REQUEST['email']);

        $novoEmail = $Email->novoEmail($idUsuario, $email);

        header("Location: ../View/contato.php");

        break;

    case 'alterarEmail' :

        $idEmail = strip_tags($_REQUEST['idEmail']);
        $email = strip_tags($_REQUEST['email']);

        $alterarEmail = $Email->alteraEmail($idEmail, $email);

        header("Location: ../View/contato.php");

        break;

    case 'listaEmail' :

        $listaEmail = $Email->listaEmail();

        echo $listaEmail;

        break;

    case 'listaEmailByIdEmail' :

        $idEmail = strip_tags($_REQUEST['idEmail']);

        $listaEmailByIdEmail = $Email->listaEmailByIdEmail($idEmail);

        echo $listaEmailByIdEmail;

        break;

    case 'listaEmailByIdUsuario' :

        $idUsuario = strip_tags($_REQUEST['idUsuario']);

        $listaEmailByIdUsuario = $Email->listaEmailByIdUsuario($idUsuario);

        echo $listaEmailByIdUsuario;

        break;

    case 'excluiEmail' :

        $idEmail = strip_tags($_REQUEST['idEmail']);

        $excluiEmail = $Email->excluiEmail($idEmail);

        header("Location: ../View/contato.php");

        break;

    case 'listaUltimosEmailsCadastrados':

        $listaUltimosEmailsCadastrados = $Email->listaUltimosEmailsCadastrados();

        echo $listaUltimosEmailsCadastrados;

        break;

    case 'totalEmail':

        $totalEmail = $Email->totalEmail();

        echo $totalEmail;

        break;

}
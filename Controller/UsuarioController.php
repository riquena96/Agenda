<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 28/09/2017
 * Time: 01:53
 */

//namespace CrudAgenda\Controller;

//use CrudAgenda\Model\Usuario;

include_once '../Model/Usuario.php';
include_once("../Model/erro_log.php");

$Usuario = new Usuario();

if (isset($_REQUEST)) {
    $action = strip_tags($_REQUEST['action']);
} else {
    $action = "";
}

switch ($action) {

    case 'novoUsuario':

        $nome = strip_tags($_REQUEST['nome']);

        if (isset($nome)) {

            $insereUsuario = $Usuario->novoUsuario($nome);
            echo $insereUsuario;

            break;
        }

        //echo "";

        break;

    case 'alterarUsuario':

        $idUsuario = strip_tags($_REQUEST['idUsuario']);
        $nome = strip_tags($_REQUEST['nome']);

        $insereUsuario = $Usuario->alteraUsuario($idUsuario, $nome);

        header("Location: ../View/contato.php");

        break;


    case 'listarUsuario':

        $listaUsuario = $Usuario->listaUsuario();

        echo $listaUsuario;

        break;

    case 'listarUsuarioById':

        $idUsuario = strip_tags($_REQUEST['idUsuario']);

        $listaUsuarioById = $Usuario->listaByIdUsuario($idUsuario);

        echo $listaUsuarioById;

        break;

    case 'excluiUsuario':

        $idUsuario = strip_tags($_REQUEST['idUsuario']);

        $excluiUsuario = $Usuario->excluiUsuario($idUsuario);

        header("Location: ../View/contato.php");

        break;

    case 'totalUsuario':

        $totalUsuario = $Usuario->totalUsuario();

        echo $totalUsuario;

        break;
}
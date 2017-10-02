<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 28/09/2017
 * Time: 10:06
 */

include_once ("./../Model/Contato.php");
include_once ("./../Model/erro_log.php");

$Contato = new Contato();

if (isset($_REQUEST)) {
    $action = strip_tags($_REQUEST['action']);
} else {
    $action = "";
}

switch ($action) {

    case 'novoContato' :

        $idUsuario = strip_tags($_REQUEST['idUsuario']);
        $ddd = strip_tags($_REQUEST['ddd']);
        $telefone = strip_tags($_REQUEST['telefone']);

        $novoContato = $Contato->novoContato($idUsuario, $ddd, $telefone);

        header("Location: ../View/contato.php");

        break;

    case 'alterarContato' :

        $idContato = strip_tags($_REQUEST['idContato']);
        $ddd = strip_tags($_REQUEST['ddd']);
        $telefone = strip_tags($_REQUEST['telefone']);

        $alterarContato = $Contato->alteraContato($idContato, $ddd, $telefone);

        header("Location: ../View/contato.php");

        break;

    case 'listarContato' :

        $listarContato = $Contato->listaContato();

        echo $listarContato;

        break;

    case 'listarContatoByIdContato' :

        $idContato = strip_tags($_REQUEST['idContato']);

        $listarContatoByIdContato = $Contato->listaContatoByIdContato($idContato);

        echo $listarContatoByIdContato;

        break;

    case 'listarContatoByIdUsuario' :

        $idUsuario = strip_tags($_REQUEST['idUsuario']);

        $listarContatoByIdUsuario = $Contato->listaContatoByIdUsuario($idUsuario);

        echo $listarContatoByIdUsuario;

        break;

    case 'excluirContato' :

        $idContato = strip_tags($_REQUEST['idContato']);

        $excluirContato = $Contato->excluiContato($idContato);

        header("Location: ../View/contato.php");

        break;

    case 'listaUltimosContatosCadastrados':

        $listaUltimosContatosCadastrados = $Contato->listaUltimosContatosCadastrados();

        echo $listaUltimosContatosCadastrados;

        break;

    case 'totalContato':

        $totalContato = $Contato->totalContato();

        echo $totalContato;

        break;

}
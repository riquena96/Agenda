<?php
session_start();

//verifica se existe uma mensagem na sessão
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/bootstrap-theme.min.css?v=1">
    <link rel="stylesheet" href="lib/css/estilo.css?v=1">
    <title>Página Inicial - Agenda Telefônica</title>
</head>
<body>

<header id="header">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuNavBar"
                        aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Agenda</a>
            </div>

            <div class="collapse navbar-collapse" id="menuNavBar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="contato.php">Lista de Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main id="main">
    <div class="container">
        <div class="row">
            <?php
            if (!empty($mensagem)) {
                echo "<span class='input-group alert alert-danger'>" . $mensagem . "</span>";
            }
            session_destroy();
            ?>
            <div class="ol-xs-9">
                <div class="col-xs-8">
                    <h2 class="h4 page-title">
                        <span>Agenda Telefônica</span>
                    </h2>
                </div>
                <div class="col-xs-12 tabelaIndex">
                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total de Usuários
                            </div>
                            <div class="panel-body" id="totalUsuario">

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total de E-mails
                            </div>
                            <div class="panel-body" id="totalEmail">

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total de Contatos
                            </div>
                            <div class="panel-body" id="totalContato">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-cs-12">
                    <div class="col-xs-6">
                        <p class="tituloTabela">Últimos e-mails cadastrados</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Data Criação</th>
                                </tr>
                                </thead>
                                <tbody id="listaEmail">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <p class="tituloTabela">Últimos contatos cadastrados</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Data Criação</th>
                                </tr>
                                </thead>
                                <tbody id="listaContato">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<footer id="footer">

</footer>

<script src="./lib/js/jquery-3.2.1.min.js?v=1"></script>
<script src="./lib/js/bootstrap.min.js?v=1"></script>
<script src="./lib/js/index.js?v=1"></script>
</body>
</html>

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
        <div id="msg"></div>
        <div class="row">
            <?php
            if (!empty($mensagem)) {
                echo "<span class='input-group alert alert-danger'>" . $mensagem . "</span>";
            }
            session_destroy();
            ?>
            <div class="col-xs-12">
                <div class="col-xs-12">
                    <h2 class="h4 page-title col-xs-9">
                        <span>Agenda Telefônica</span>
                    </h2>
                </div>
                <div class="col-xs-12 listaBotao">
                    <div class="col-xs-3">
                        <div class="tools">
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalInsereUsuario">
                                <i class="glyphicon glyphicon-plus"></i> Usuário
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="tools">
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalInsereEmail"
                               id="insereEmail">
                                <i class="glyphicon glyphicon-plus"></i> E-mail
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="tools">
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalInsereContato"
                               id="insereContato">
                                <i class="glyphicon glyphicon-plus"></i> Contato
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover>
                            <thead>
                            <tr>
                                <th width="50%">Nome</th>
                                <th>Editar Usuário</th>
                                <th>Excluir Usuário</th>
                            </tr>
                            </thead>
                            <tbody id="listaUsuario">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>

<footer id="footer">

</footer>

<div class="modal fade" id="modalInsereUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Adicionar Usuário</h4>
                <div id="msgInsereUsuario"></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <label>Nome: </label>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="adicionarUsuario">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlteraUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="../Controller/UsuarioController.php">
                <input type="hidden" name="action" value="alterarUsuario">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Alterar Usuário</h4>
                    <div id="msgAlteraUsuario"></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            <label>Nome: </label>
                        </div>
                        <div class="col-lg-4 col-md-3" id="campoNomeAltera">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExcluiUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="../Controller/UsuarioController.php">
                <input type="hidden" name="action" value="excluiUsuario">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Excluir Usuário? </h4>
                    <div id="msgExcluiUsuario"></div>
                </div>
                <div class="modal-body">
                    <p>Este Usuário será removido do histórico do banco de dados.</p>
                    <div class="col-lg-4 col-md-3" id="campoExcluiUsuario">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExcluiEmail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="../Controller/EmailController.php">
                <input type="hidden" name="action" value="excluiEmail">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Excluir E-mail? </h4>
                    <div id="msgExcluiEmail"></div>
                </div>
                <div class="modal-body">
                    <p>Este E-mail será removido do histórico do banco de dados.</p>
                    <div class="col-lg-4 col-md-3" id="campoExcluiEmail">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExcluiTelefone" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="../Controller/ContatoController.php">
                <input type="hidden" name="action" value="excluirContato">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Excluir Contato? </h4>
                    <div id="msgExcluiContato"></div>
                </div>
                <div class="modal-body">
                    <p>Este Contato será removido do histórico do banco de dados.</p>
                    <div class="col-lg-4 col-md-3" id="campoExcluiContato">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInsereEmail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="../Controller/EmailController.php">
                <input type="hidden" name="action" value="novoEmail">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Adicionar E-mail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            <label>Usuário: </label>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <select class="form-control" name="idUsuario" required id="listaOptionUsuario">

                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-lg-4 col-md-3">
                            <label>E-mail: </label>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInsereContato" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="../Controller/ContatoController.php">
                <input type="hidden" name="action" value="novoContato">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Adicionar Contato</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            <label>Usuário: </label>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <select class="form-control" name="idUsuario" required id="listaOptionUsuarioContato">

                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-lg-4 col-md-3">
                            <label>Telefone: </label>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <input type="text" name="ddd" class="form-control" maxlength="2" placeholder="DDD" required>
                        </div>
                        <div class="col-lg-5 col-md-4">
                            <input type="text" name="telefone" class="form-control" maxlength="9" placeholder="Telefone"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInfoUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="nomeUsuario"></h4>
            </div>
            <div class="modal-body">
                <div class="dadosUsuario">

                    <div class="row" id="listaEmailByUsuario">
                        <p><label>E-mail: </label></p>
                        <ul id="listaEmailUsuario">

                        </ul>
                    </div>
                    <div class="row" id="listaContatoByUsuario">
                        <p><label>Telefone: </label></p>
                        <ul id="listaContatoUsuario">

                        </ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlteraEmail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="../Controller/EmailController.php">
                <input type="hidden" name="action" value="alterarEmail">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Adicionar E-mail</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-lg-4 col-md-3">
                            <label>E-mail: </label>
                        </div>
                        <div class="col-lg-4 col-md-3" id="dadosEmail">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlteraTelefone" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="../Controller/ContatoController.php">
                <input type="hidden" name="action" value="alterarContato">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Alterar Contato</h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="dadosContato" style="padding-top: 20px;">
                        <div class="col-lg-4 col-md-3">
                            <label>Telefone: </label>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <input type="number" name="ddd" class="form-control" value="" required>
                        </div>
                        <div class="col-lg-5 col-md-4">
                            <input type="number" name="telefone" class="form-control" value=""
                                   required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="./lib/js/jquery-3.2.1.min.js?v=1"></script>
<script src="./lib/js/bootstrap.min.js?v=1"></script>
<script src="./lib/js/script.js?v=1"></script>
</body>
</html>

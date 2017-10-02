/**
 * Created by henrique on 27/09/2017.
 */

const baseUrl = 'http://localhost:8080/crudAgenda/';

var listaUsuario = function () {

    $.ajax({
        url: baseUrl + 'Controller/UsuarioController.php',
        type: 'POST',
        dataType: 'json',
        async: false,
        data: {
            action: 'listarUsuario'
        },
        success: function (data) {
            if (data != '') {
                $('#listaUsuario').empty();
                for (var i = 0; data.data.length > i; i++) {
                    $('#listaUsuario').append(
                        '<tr>' +
                        '<td><a id="modalInformacaoUsuario" data-toggle="modal" data-target="#modalInfoUsuario" data-id="' + data.data[i].idUsuario + '" data-nome="' + data.data[i].nome + '">' + data.data[i].nome + '</a></td>' +
                        '<td><a id="modalAltera" data-toggle="modal" data-target="#modalAlteraUsuario" data-id="' + data.data[i].idUsuario + '" data-nome="' + data.data[i].nome + '"><i class="glyphicon glyphicon-edit"></i></a></td>' +
                        '<td><a id="modalExclui" data-toggle="modal" data-target="#modalExcluiUsuario" data-id="' + data.data[i].idUsuario + '"><i class="glyphicon glyphicon-trash"></i></a></td>' +
                        '</tr>'
                    );
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

$(document).on('click', '#excluiEmail', function () {

    $('#modalInfoUsuario').modal('hide');

    var id = $(this).attr('data-id');

    $('#campoExcluiEmail').empty().append(
        '<input type="hidden" name="idEmail" id="idEmail" class="form-control" value="' + id + '" required>'
    );

});

$(document).on('click', '#excluiTelefone', function () {

    $('#modalInfoUsuario').modal('hide');

    var id = $(this).attr('data-id');

    $('#campoExcluiContato').empty().append(
        '<input type="hidden" name="idContato" id="idContato" class="form-control" value="' + id + '" required>'
    );

});

$(document).on('click', '#modalExclui', function () {

    var id = $(this).attr('data-id');

    $('#campoExcluiUsuario').empty().append(
        '<input type="hidden" name="idUsuario" id="idUsuario" class="form-control" value="' + id + '" required>'
    );

});

$(document).on('click', '#adicionarUsuario', function () {

    var nome = $('#nome').val();

    if (nome == '') {
        $('#msgInsereUsuario').append(
            '<div class="alert alert-warning alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            'Insira um nome válido!' +
            '</div>');
        return;
    }

    $.ajax({
        url: baseUrl + 'Controller/UsuarioController.php',
        type: 'POST',
        dataType: 'json',
        async: false,
        data: {
            action: 'novoUsuario',
            nome: nome
        },
        beforeSend: function () {
            $('#adicionarUsuario').attr('disabled', 'disabled').html('Aguarde...');
        },
        success: function (data) {
            if (data == 'Usuário Cadastrado como Sucesso!') {
                $('#msg').append(
                    '<div class="alert alert-success alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    data +
                    '</div>');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {
            $('#msgInsereUsuario').empty();
            $('#alterarUsuario').removeAttr('disabled').html('Salvar');
            $('#modalInsereUsuario').modal('hide');
            listaUsuario();
        }
    });

});

$(document).on('click', '#modalAltera', function () {

    var id = $(this).attr('data-id');
    var nome = $(this).attr('data-nome');

    $('#campoNomeAltera').empty().append(
        '<input type="text" name="nome" id="nomeUsuario" class="form-control" value="' + nome + '" required>' +
        '<input type="hidden" name="idUsuario" id="idUsuario" class="form-control" value="' + id + '" required>'
    );

});

$('#insereEmail').click(function () {

    debugger;

    $.ajax({
        url: baseUrl + 'Controller/UsuarioController.php',
        type: 'POST',
        dataType: 'json',
        async: false,
        data: {
            action: 'listarUsuario'
        },
        success: function (data) {
            if (data != '') {
                $('#listaOptionUsuario').empty();
                for (var i = 0; data.data.length > i; i++) {
                    $('#listaOptionUsuario').append(
                        '<option value="' + data.data[i].idUsuario + '">' + data.data[i].nome + '</option>'
                    );
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

});

$('#insereContato').click(function () {

    debugger;

    $.ajax({
        url: baseUrl + 'Controller/UsuarioController.php',
        type: 'POST',
        dataType: 'json',
        async: false,
        data: {
            action: 'listarUsuario'
        },
        success: function (data) {
            if (data != '') {
                $('#listaOptionUsuarioContato').empty();
                for (var i = 0; data.data.length > i; i++) {
                    $('#listaOptionUsuarioContato').append(
                        '<option value="' + data.data[i].idUsuario + '">' + data.data[i].nome + '</option>'
                    );
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

});

var listaEmail = function (id) {

    var idUser = id;

    $.ajax({
        url: baseUrl + 'Controller/EmailController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'listaEmailByIdUsuario',
            idUsuario: idUser
        },
        async: false,
        success: function (data) {
            if (data.data != '') {
                $('#listaEmailByUsuario').show();
                $('#listaEmailUsuario').empty();

                for (var i = 0; data.data.length > i; i++) {
                    $('#listaEmailUsuario').append(
                        '<li>' + data.data[i].email + ' ' +
                        '<span class="modalDados">' +
                        '<a id="alterarEmail" data-email="' + data.data[i].email + '" data-id="' + data.data[i].idEmailUsuario + '" data-toggle="modal" data-target="#modalAlteraEmail">' +
                        '<i class="glyphicon glyphicon-edit iconEdit"></i>' +
                        '</a>' +
                        '<a id="excluiEmail" data-id="' + data.data[i].idEmailUsuario + '" data-toggle="modal" data-target="#modalExcluiEmail">' +
                        '<i class="glyphicon glyphicon-trash iconEdit"></i>' +
                        '</a>' +
                        '</span>' +
                        '</li>'
                    );
                }
                return;
            }
            $('#listaEmailByUsuario').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

var listaTelefone = function (id) {

    var idUser = id;

    $.ajax({
        url: baseUrl + 'Controller/ContatoController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'listarContatoByIdUsuario',
            idUsuario: idUser
        },
        async: false,
        success: function (data) {
            if (data.data != '') {
                $('#listaContatoByUsuario').show();
                $('#listaContatoUsuario').empty();

                for (var i = 0; data.data.length > i; i++) {
                    $('#listaContatoUsuario').append(
                        '<li>(' + data.data[i].ddd + ') ' + data.data[i].telefone + '' +
                        '<span class="modalDados">' +
                        '<a id="alteraTelefone" data-id="' + data.data[i].idContatoUsuario + '" data-ddd="' + data.data[i].ddd + '" data-telefone="' + data.data[i].telefone + '" data-toggle="modal" data-target="#modalAlteraTelefone">' +
                        '<i class="glyphicon glyphicon-edit iconEdit"></i>' +
                        '</a>' +
                        '<a id="excluiTelefone" data-id="' + data.data[i].idContatoUsuario + '" data-toggle="modal" data-target="#modalExcluiTelefone">' +
                        '<i class="glyphicon glyphicon-trash iconEdit"></i>' +
                        '</a>' +
                        '</span>' +
                        '</li>'
                    );
                }
                return;
            }
            $('#listaContatoByUsuario').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

$(document).on('click', '#modalInformacaoUsuario', function () {

    var idUsuario = $(this).attr('data-id');
    var nome = $(this).attr('data-nome');

    $('#nomeUsuario').empty().append(nome);

    listaEmail(idUsuario);
    listaTelefone(idUsuario);

});

$(document).on('click', '#alterarEmail', function () {

    $('#modalInfoUsuario').modal('hide');

    var id = $(this).attr('data-id');
    var email = $(this).attr('data-email');

    $('#dadosEmail').empty().append(
        '<input type="email" name="email" class="form-control" value="' + email + '" required>' +
        '<input type="hidden" name="idEmail" value="' + id + '">'
    );

});

$(document).on('click', '#alteraTelefone', function () {

    $('#modalInfoUsuario').modal('hide');

    var id = $(this).attr('data-id');
    var ddd = $(this).attr('data-ddd');
    var telefone = $(this).attr('data-telefone');

    $('#dadosContato').empty().append(
        '<div class="col-lg-4 col-md-3">' +
        '<label>Telefone: </label>' +
        '</div>' +
        '<div class="col-lg-2 col-md-3">' +
        '<input type="number" name="ddd" class="form-control" value="' + ddd + '" required>' +
        '</div>' +
        '<div class="col-lg-5 col-md-4">' +
        '<input type="number" name="telefone" class="form-control" value="' + telefone + '"' +
        'required>' +
        '</div>' +
        '<input type="hidden" name="idContato" value="' + id + '">'
    );

});

$(document).ready(function () {
    listaUsuario();
});
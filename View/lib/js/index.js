/**
 * Created by henrique on 29/09/2017.
 */
var listaEmail = function () {

    $.ajax({
        url: './../Controller/EmailController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'listaUltimosEmailsCadastrados',
        },
        async: false,
        success: function (data) {
            if (data.data != '') {

                for (var i = 0; data.data.length > i; i++) {
                    $('#listaEmail').append(
                    '<tr>' +
                    '<td>' + data.data[i].nome + '</td>' +
                    '<td>' + data.data[i].email + '</td>' +
                    '<td>' + data.data[i].dataCriacao + '</td>' +
                    '</tr>'
                    );
                }
                return;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

var listaContato = function () {

    $.ajax({
        url: './../Controller/ContatoController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'listaUltimosContatosCadastrados',
        },
        async: false,
        success: function (data) {
            if (data.data != '') {

                for (var i = 0; data.data.length > i; i++) {
                    $('#listaContato').append(
                        '<tr>' +
                        '<td>' + data.data[i].nome + '</td>' +
                        '<td>' + data.data[i].telefone + '</td>' +
                        '<td>' + data.data[i].dataCriacao + '</td>' +
                        '</tr>'
                    );
                }
                return;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

var totalUsuario = function () {

    $.ajax({
        url: './../Controller/UsuarioController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'totalUsuario',
        },
        async: false,
        success: function (data) {
            if (data.data != '') {

                for (var i = 0; data.data.length > i; i++) {
                    $('#totalUsuario').append(data.data[i].total);
                }
                return;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

var totalEmail = function () {

    $.ajax({
        url: './../Controller/EmailController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'totalEmail',
        },
        async: false,
        success: function (data) {
            if (data.data != '') {

                for (var i = 0; data.data.length > i; i++) {
                    $('#totalEmail').append(data.data[i].total);
                }
                return;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

var totalContato = function () {

    $.ajax({
        url: './../Controller/ContatoController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'totalContato',
        },
        async: false,
        success: function (data) {
            if (data.data != '') {

                for (var i = 0; data.data.length > i; i++) {
                    $('#totalContato').append(data.data[i].total);
                }
                return;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        },
        complete: function (jqXHR, textStatus) {

        }
    });

};

$(document).ready(function () {
    totalUsuario();
    totalEmail();
    totalContato();
    listaEmail();
    listaContato();
});
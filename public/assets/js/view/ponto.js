// ========VARIÁVEIS BASE=============
var url = window.location.href;

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela')) listar();
});

function listar() {
    $.ajax({
        url: url + '/listar',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela').html(result);
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
};

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on("click", '.prepare-upload', function () { preparaUpload($(this).data('id')); });

function preparaUpload(id) {
    $('[name="id_ponto"]').val(id);
}

function updateStatus(idPonto, idStatus, mes) {
    $.ajax({
        url: url+'/updatestatus',
        method: 'POST',
        data: {id: idPonto, status: idStatus},
        success: function (result) {
            if(result === 'success'){
                listar();
                $("#badgeMes"+mes).load(location.href + " #badgeMes"+mes);
                setTimeout(
                    function() 
                    {
                        showFolha(mes);
                    }, 1500);
            }
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
}

function updateStatusAnexo(idPonto, idStatus, mes) {
    $.ajax({
        url: url+'/updatestatusanexo',
        method: 'POST',
        data: {id: idPonto, status_anexo: idStatus},
        success: function (result) {
            if(result === 'success'){
                listar();
                setTimeout(
                    function() 
                    {
                        showFolha(mes);
                    }, 1500);
            }
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
}

function resetInputs() {
    $('input[class="form-control"]').val('');
}

function gerarFolha(){
    $.ajax({
        url: url + '/gerarfolha',
        method: 'POST',
        success: function (result) {
            toast(result);
            if(result == 'success'){
                listar();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
}

function salvar(event, formdata){
   event.preventDefault();
        $.ajax({
            url: url+'/save',
            method: 'POST',
            data: new FormData(formdata),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result);
                resetInputs();
                toast(result);
                if(result == 'success'){
                    listar();
                }
            },
            error: function (result) {
                console.log('Erros ' + result);            
            }
        });
}


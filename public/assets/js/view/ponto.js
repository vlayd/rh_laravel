// ========VARIÁVEIS BASE=============
var url = window.location.href;

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_ponto')) listar();
});

function listar() {
    $.ajax({
        url: url + '/listar',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_ponto').html(result);
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
}

function preparaEdit(id, mes, idUser, oldAnexo) {
    $('input[name="idModal"]').val(id);
    $('input[name="mesModal"]').val(mes);
    $('input[name="userModal"]').val(idUser);
    $('input[name="oldAnexoModal"]').val(oldAnexo);
}

function showFolha(mes) {
    $.each(['0','01','02','03','04','05','06','07','08','09','10','11','12'], function(index, value){
        if(mes == value){
            $('.btnMes'+value).removeClass('bg-secondary');
            $('.badgeAniversario'+value).removeClass('badge-danger');
            $('.btnMes'+value).addClass('bg-success');
            $('.badgeAniversario'+value).addClass('bg-danger');
        } else {
            $('.btnMes'+value).removeClass('bg-success');
            $('.badgeAniversario'+value).removeClass('bg-danger');
            $('.btnMes'+value).addClass('bg-secondary');
            $('.badgeAniversario'+value).addClass('badge-danger');
        }
        $('.badgeAniversario'+value).addClass('');
    });
    if(mes == '0'){
        $('.mes').removeClass('d-none');
    } else {
        $('.mes').addClass('d-none');
        $('.mes'+mes).removeClass('d-none');
    }
    
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

$('#form-save').on('submit', function (e) {
    e.preventDefault();
    urlSave = url+'/save';
    $.ajax({
        url: urlSave,
        method: 'POST',
        data: new FormData(this),
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
});
// ========VARIÁVEIS BASE=============
var url = window.location.href;

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_cargo')) listar();
});

function listar() {
    $.ajax({
        url: url + '/listar',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_cargo').html(result);
        }
    });
}

function preparaEdit(id, tipo) {
    var checkTerceirizado = false;
    if (id == 0) {
        $('#nomeModal').val('');
        $('input[name="idModal"]').val('');
    } else {
        $('#nomeModal').val($('#nome'+id).html());
        $('input[name="idModal"]').val(id);
        if(tipo == 1) checkTerceirizado = true;
    }
    $('input[name="tipoModal"]').prop('checked', checkTerceirizado);
}

function resetInputs() {
    $('input[class="form-control"]').val('');
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
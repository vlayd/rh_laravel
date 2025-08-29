// ========VARIÁVEIS BASE=============
var url = window.location.href;

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_feriado')) listar();
});

function listar() {
    $.ajax({
        url: url + '/listar',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_feriado').html(result);
        }
    });
}

function preparaEdit(id, tipo) {
    if (id == 0 && tipo == 0) {
        resetInputs();
    } else if(id != 0 && tipo == 0) {
        $('#nomeModal').val($('#nome'+id).html());
        $('#dataModal').val($('#data'+id).html());
        $('#tipoModal').val($('#tipo'+id).html()).change();
        $('#anoModal').val($('#ano'+id).html()).change();
        $('input[name="idModal"]').val(id);
    } else {
        var data = $('#data'+id).html();
        console.log(data.replace('2024', '2025'));
        $('#nomeModal').val($('#nome'+id).html());
        $('#dataModal').val(data.replace('2024', '2025'));
        $('#tipoModal').val($('#tipo'+id).html()).change();
        $('#anoModal').val(new Date().getFullYear()).change();
        $('input[name="idModal"]').val('');
    }
}

function resetInputs() {
    $('#nomeModal').val('');
    $('input[name="idModal"]').val('');
    $('#dataModal').val('');
    $('#tipoModal').val('0').change();
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
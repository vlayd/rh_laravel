var baseUrl = $('#base_url').html();
var urlAnexo = baseUrl+'anexo/';

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
   
});

$('body').on("click", '.btn_prepare_save', function () { prepereSalvar($(this).data('id')); });
$('body').on("click", '.btn_prepare_delete', function () { prepereDeletar($(this).data('id')); });

// ========FUNÇÕES ÚTEIS=============
function selectAnexo(item) {
    if(item == 'perfil'){
        $('.item1').removeClass('d-none');
        $('.item2').removeClass('d-none');
        $('.item3').removeClass('d-none');
        $('.item4').addClass('d-none');
        $('.item5').addClass('d-none');
        $('.item6').addClass('d-none');
        $('.item7').addClass('d-none');
        $('.item8').addClass('d-none');
        $('.item9').addClass('d-none');
        $('.item10').addClass('d-none');
    } else if(item == 'profissional'){
        $('.item1').addClass('d-none');
        $('.item2').addClass('d-none');
        $('.item3').addClass('d-none');
        $('.item4').addClass('d-none');
        $('.item5').removeClass('d-none');
        $('.item6').removeClass('d-none');
        $('.item7').removeClass('d-none');
        $('.item8').removeClass('d-none');
        $('.item9').removeClass('d-none');
        $('.item10').addClass('d-none');
    } else if(item == 'folha'){
        $('.item1').addClass('d-none');
        $('.item2').addClass('d-none');
        $('.item3').addClass('d-none');
        $('.item4').removeClass('d-none');
        $('.item5').addClass('d-none');
        $('.item6').addClass('d-none');
        $('.item7').addClass('d-none');
        $('.item8').addClass('d-none');
        $('.item9').addClass('d-none');
        $('.item10').addClass('d-none');
    } else if(item == 'funcao'){
        $('.item1').addClass('d-none');
        $('.item2').addClass('d-none');
        $('.item3').addClass('d-none');
        $('.item4').addClass('d-none');
        $('.item5').addClass('d-none');
        $('.item6').addClass('d-none');
        $('.item7').addClass('d-none');
        $('.item8').addClass('d-none');
        $('.item9').addClass('d-none');
        $('.item10').removeClass('d-none');
    } else {
        $('.item1').removeClass('d-none');
        $('.item2').removeClass('d-none');
        $('.item3').removeClass('d-none');
        $('.item4').removeClass('d-none');
        $('.item5').removeClass('d-none');
        $('.item6').removeClass('d-none');
        $('.item7').removeClass('d-none');
        $('.item8').removeClass('d-none');
        $('.item9').removeClass('d-none');
        $('.item10').removeClass('d-none');
    }
}

function resetInputs() {
    $('[name="nome"]').val('');
    $('[name="ordem"]').val('0');
    $('[name="tipo"]').val('0').change();
    $('[name="anexo"]').val('');
    $('[name="id_anexo"]').val('');
}

function prepereSalvar(id) {
    if (id == '0') return resetInputs();
    $('[name="nome"]').val($('#nome'+id).html());
    $('[name="ordem"]').val($('#ordem'+id).html());
    $('[name="tipo"]').val($('#tipo'+id).html()).change();
    $('[name="id_anexo"]').val(id);
    $('[name="anexo"]').val('');
}

function prepereDeletar(id) {
    $('#deletar_nome').html($('#nome' + id).html());
    $('[name="id"]').val(id);
}

function deletar(id) {
    $.ajax({
        url: urlAnexo + 'deletar',
        method: 'POST',
        data: {id: id},
        success: function (result) {
            if(result == 'success') listar();
            else toast('error', 'Erro ao deletar usuário!');
        },
        error: function (result) {
            toast('error', 'Erro desconhecido!');
        }
    });
}
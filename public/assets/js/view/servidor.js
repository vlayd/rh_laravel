// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var selectAnexos = null;
var selectAnexosInterino = null;

if (document.getElementById('choices-tags-h')) {
    var tagsH = document.getElementById('choices-tags-h');
    selectAnexos = new Choices(tagsH, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
      duplicateItemsAllowed: false,
    });
}

if (document.getElementById('choices-tags-i')) {
    var tagsI = document.getElementById('choices-tags-i');
    selectAnexosInterino = new Choices(tagsI, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
      duplicateItemsAllowed: false,
    });
}

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_servidor')) listar();
});

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on("change", '#escolaridade', function () { validaEscolaridade(); });
$('body').on("click", '.prepare_delete_historico', function () { prepareDeleteHistorico($(this).data('id')); });
$('body').on("click", '.prepare_save_interino', function () { editInterino($(this).data('id'), $(this).data('hist')); });
$('body').on("click", '.prepare_delete_interino', function () { prepareDeleteInterino($(this).data('id')); });

// ========FUNÇÕES ÚTEIS=============
function listarAnexos() {
    urlLista = url.replace('anexo', 'anexo/listar');
    $.ajax({
        url: urlLista,
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_anexo').html(result);
        }
    });
}

function listar() {
    $.ajax({
        url: url + '/listar',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_servidor').html(result);
        }
    });
}

function copyText(info) {
    navigator.clipboard.writeText($('#'+info).html());
    toast('success', $('#'+info+'Label').html()+ ' copiado!');
}


if(document.getElementById('tabMesAtual')){
    $('#tabMesAtual').on('click', function () {
        show1('pMesAtual', 'listaMesAtual', 'pMesSeguinte','listaMesSeguinte', 'pMesAnterior', 'listaMesAnterior');
    });
    $('#tabMesSeguinte').on('click', function () {
        show1('pMesSeguinte', 'listaMesSeguinte', 'pMesAtual','listaMesAtual', 'pMesAnterior', 'listaMesAnterior');
    });
    $('#tabMesAnterior').on('click', function () {
        show1('pMesAnterior', 'listaMesAnterior', 'pMesAtual','listaMesSeguinte', 'pMesSeguinte', 'listaMesAtual');
    });
}

$("#form_cpf").on("submit", function(e) {
    if($('#btnSalvarCpf').prop("disabled") == true) e.preventDefault();
});

function changePhoto(idFoto, file) {
    let ext = file.files[0].type;
    if($.inArray(ext, ['image/webp','image/gif','image/png','image/jpg','image/jpeg']) == -1) {
        toastr["error"]("Formato não aceito!", "Erro");
    } else {
        document.getElementById(idFoto).src = window.URL.createObjectURL(file.files[0]);
    }
}

function actionBtnSaveCpf(confirm, msg){
    if(!confirm){
        $('#btnSalvarCpf').prop("disabled", true);
        $("#msgErro").html(msg);
    } else {
        $('#btnSalvarCpf').prop("disabled", false);
        $("#msgErro").html('');
    }
}

function validaEscolaridade() {
    if($("#escolaridade").val() >= 6){
        $('#orgaoClasse').removeClass('d-none');
    } else {
        $('#orgaoClasse').addClass("d-none");
    }
}

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
        $('.item9').addClass('d-none');
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
    }
}

function validadeCpf(cpf) {
    let strCPF = cpf.replace(/\.|-/gm,'');
    if (strCPF.length === 11){
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000") return actionBtnSaveCpf(false, 'CPF inválido!');

        for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)) ) return actionBtnSaveCpf(false, 'CPF inválido!');

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) ) return actionBtnSaveCpf(false, 'CPF inválido!');
        return pesquisaCPF(strCPF);
    } else {
        $('#btnSalvarCpf').prop("disabled", true);
        $("#msgErro").html('');
        return;
    }
}

function pesquisaCPF(cpf) {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url+'/pesquisacpf',
        method: 'POST',
        dataType: 'html',
        data: {cpf: cpf},
        success: function (result) {
            console.log(result);
            if(result > 0) return actionBtnSaveCpf(false, 'CPF já cadastrado!');
            else return actionBtnSaveCpf(true, '');
        }
    });
}

function alteraStatus(idUser, idStatus, nomeUser){
    $('#tipo').html('updatestatus');
    $('input[name="id_user"]').val(idUser);
    $('input[name="value_info"]').val(idStatus);
    let status = 'Bloquear';
    let classe = 'bg-gradient-danger';
    let removeClasse = 'bg-gradient-success';
    let modalTitle = 'Bloqueando usuário...';
    if(idStatus === '1'){
        console.log(idStatus);
        status = 'Desbloquear';
        classe = 'bg-gradient-success';
        removeClasse = 'bg-gradient-danger';
        modalTitle = 'Desbloqueando usuário...';
    }
    $('#btn_acao').html(status);
    $('#modalAlteraAcaoLabel').html(modalTitle);
    $('#btn_acao').removeClass(removeClasse);
    $('#modal-header').removeClass(removeClasse);
    $('#btn_acao').addClass(classe);
    $('#modal-header').addClass(classe);
    $('#modal-body').html('Deseja ' + status.toLowerCase() + ' <strong>'+ nomeUser + '</strong>?');
}

function resetaSenha(idUser, cpfUser, nomeUser){
    $('#tipo').html('resetpassword');
    $('input[name="id_user"]').val(idUser);
    $('input[name="value_info"]').val(cpfUser);
    let acao = 'Resetar';
    let classe = 'bg-gradient-danger';
    $('#btn_acao').html(acao);
    $('#modalAlteraAcaoLabel').html('Resetando senha...');
    $('#btn_acao').addClass(classe);
    $('#modal-header').addClass(classe);
    $('#modal-body').html('Deseja resetar senha de <strong>'+ nomeUser + '</strong>?');
}


$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#form-save-acao').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: url+'/updatestatus',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            console.log(result);
            if(result === 'success'){
                listar();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);
        }
    });
});

$('#form-save').on('submit', function (e) {
    e.preventDefault();
    urlSave = url.replace('edit', 'save');
    $.ajax({
        url: urlSave,
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {

        },
        error: function (result) {
        }
    });
});

function addItem() {
    resetInputs();
}

function editItem(idItem, item) {
    resetInputs();
    let id = idItem.replace('edit', '');
    $('#'+item).val($('#nome'+id).html());
    $('input[name="id"]').val(id);
}

function editHistorico(id) {
    //Evita duplicidade
    
    if($('#dados'+id).html() != null){
        selectAnexos.clearStore();
        const anexos = JSON.parse($('#jsonAnexo'+id).html());
        const obj = JSON.parse($('#dados'+id).html());
        
        $('#contrato').val(obj.contrato).change();
        $('#cargo').val(obj.cargo).change();
        $('#matricula').val(obj.matricula);
        $('#funcao').val(obj.funcao);
        $('#gratificacao').val(obj.gratificacao).change();
        $('#setor').val(obj.setor).change();
        $('#chefia').val(obj.chefia).change();
        $('#data_contratacao').val(obj.data_contratacao);
        $('#data_rescisao').val(obj.data_rescisao);
        $('input[name="id_historico"]').val(id);
        
        $.each(['1','2','3','4','5','6','7','8'], function(index, value) {
            if($.inArray(value, JSON.parse(obj.alteracao)) >= 0) $('input[type="checkbox"][value='+value+']').attr("checked", true);
            else $('input[type="checkbox"][value='+value+']').attr("checked", false);
        });
        if(obj.atual == 1) $('[name="atual"]').attr("checked", true);
        else $('[name="atual"]').attr("checked", false);
        selectAnexos.setChoices(anexos);
    }
    

}

function showAniversario(mes) {
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

function getAnexos(){
}

function editInterino(idI, idH) {  
    $('[name="id_historico_interino"]').val(idH);
    //Evita duplicidade
    selectAnexosInterino.clearStore();
    const anexos = JSON.parse($('#jsonAnexoInt'+idI).html());
    selectAnexosInterino.setChoices(anexos);
    if(idI == '0') {
        return resetInputsInterino();
    }
    
    const obj = JSON.parse($('#dados_interino'+idI).html());
    
    $('[name="funcao_interina"]').val(obj.funcao);
    $('[name="setor_interino"]').val(obj.setor).change();
    $('[name="observacao_interino"]').val(obj.observacao);
    $('[name="chefia_interino"]').val(obj.chefia).change();
    $('[name="data_contratacao_interino"]').val(obj.data_contratacao);
    $('[name="data_rescisao_interino"]').val(obj.data_rescisao);
    $('[name="id_interino"]').val(idI);
}

function editItemAnexo(idItem, item) {
    resetInputs();
    let id = idItem.replace('edit', '');
    $('#'+item).val($('#nome'+id).html());
    $('input[name="id"]').val(id);
}

function deleteItem(idItem) {
    resetInputs();
    let id = idItem.replace('delete', '');
    $('#dadoExcluir').html($('#nome'+id).html());
    $('input[name="id"]').val(id);
}

$('#form-save-anexo').on('submit', function (e) {
    e.preventDefault();
    urlSave = url.replace('anexo', 'anexo/save');
    $.ajax({
        url: urlSave,
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            toast(result);
            if(result == 'success'){
                resetInputs();
                if(document.getElementById('tabela_anexo')) listarAnexos();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);
        }
    });
});

$('#form-delete-anexo').on('submit', function (e) {
    e.preventDefault();
    urlSave = baseUrl+'anexo/delete';
    $.ajax({
        url: urlSave,
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            toast(result);
            if(result == 'success'){
                resetInputs();
                if(document.getElementById('tabela_anexo')) listarAnexos();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);
        }
    });
});

$("#btn_inativo").on("click", function() {
    $('.status0').removeClass("d-none");
    $('.status1').addClass("d-none");
  }
);

$("#btn_ativo").on("click", function() {
    $('.status1').removeClass("d-none");
    $('.status0').addClass("d-none");
  }
);

$("#btn_todos").on("click", function() {
    $('.status0').removeClass("d-none");
    $('.status1').removeClass("d-none");
  }
);

function show1(id1a, id1b, id2a, id2b, id3a, id3b) {
    $('#'+id1a).removeClass("d-none");
    $('#'+id1b).removeClass("d-none");
    $('#'+id2a).addClass("d-none");
    $('#'+id2b).addClass("d-none");
    $('#'+id3a).addClass("d-none");
    $('#'+id3b).addClass("d-none");
    return;
}

function config(mostrar) {
    if(mostrar == 1){
        $('.colunas').addClass("d-none");
        $('.config').removeClass("d-none");
    } else {
        $('.colunas').removeClass("d-none");
        $('.config').addClass("d-none");
    }
    return;
}

function prepareCopy(item) {
    $('#cpfCopy').html($('#'+item+'cpf').html());
    $('#telefoneCopy').html($('#'+item+'telefone').html());
    $('#emailCopy').html($('#'+item+'email').html());
    $('#email2Copy').html($('#'+item+'email2').html());
    $('#matriculaCopy').html($('#'+item+'matricula').html());
}

function prepareDeleteInterino(id) {
    $('[name="id_interino"]').val(id);
}

function prepareDeleteHistorico(id) {
    $('[name="id_historico"]').val(id);
}

function toast(tipo, msg='Erro ao salvar!') {
    return $.toast({
        heading: tipo == 'success'?'Sucesso':'Erro',
        text: msg,
        icon: tipo,
        hideAfter: 2000,
        position: 'bottom-center',
    });
}

function resetInputs() {
    //Recupera o valor do tipo, pois o type=hidden vai ser zerado
    let tipoAnexo = $('input[name="tipo"]').val();
    $('input[type="text"]').val('');
    $('input[type="hidden"]').val('');
    $('input[type="file"]').val('');
    $('input[name="tipo"]').val(tipoAnexo);
}

function resetInputsInterino() {
    $('[name="funcao_interina"]').val('');
    $('[name="setor_interino"]').val('0').change();
    $('[name="observacao_interino"]').val('');
    $('[name="chefia_interino"]').val('1').change();
    $('[name="data_contratacao_interino"]').val('');
    $('[name="data_rescisao_interino"]').val('');
}

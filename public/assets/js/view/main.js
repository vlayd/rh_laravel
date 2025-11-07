// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    itemMenu(item, subItem);
    if(document.getElementById('escolaridade')) validaEscolaridade();
    if(document.getElementById('contrato')) validaContrato();
});

// ========FUNÇÕES ÚTEIS=============
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

if(document.getElementById('contrato')){
    $("#contrato").on("change", function(a) {
        validaContrato();
    }
)};

if(document.getElementById('escolaridade')){
    $("#escolaridade").on("change", function(a) {
        validaEscolaridade();
    });
}

$("#form_cpf").on("submit", function(e) {
    if($('#btnSalvarCpf').prop("disabled") == true) e.preventDefault();
});

$(".form_cpf").on("submit", function(e) {
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

$('#form-save-all').on('submit', function (e) {
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
            console.log('Erros ' + result);
        }
    });
});

function deleteItem(idItem) {
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
            console.log(result);
            toast(result);
            if(result == 'success'){
                if(document.getElementById('tabela_anexo')) listarAnexos();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);
        }
    });
});

function itemMenu(item, subItem) {
    $('#aba'+item).addClass('active');
    $('#aba'+item).removeClass('collapsed');
    $('#aba'+item).attr('aria-expanded', true);
    $('#collapse'+item).addClass('show');
    $('#li'+subItem).addClass('active');
    $('#a'+subItem).addClass('active');
}

// ========SCRIPS DE EVENTOS ÚTEIS=============
$('#form-save-all').on('submit', function (e) {
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
            console.log(result);
            toast(result);
            if(result == 'success'){
                if(document.getElementById('tabela_anexo')) listarAnexos();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);
        }
    });
});

function show1(id1a, id1b, id2a, id2b, id3a, id3b) {
    $('#'+id1a).removeClass("d-none");
    $('#'+id1b).removeClass("d-none");
    $('#'+id2a).addClass("d-none");
    $('#'+id2b).addClass("d-none");
    $('#'+id3a).addClass("d-none");
    $('#'+id3b).addClass("d-none");
    return;
}

function toast(tipo, msg='Erro ao salvar!') {
    return $.toast({
        heading: tipo == 'success'?'Sucesso':'Erro',
        text: tipo == 'success'?'Salvo com sucesso!':msg,
        icon: tipo,
        hideAfter: 2000,
        position: 'bottom-center',
    });
}

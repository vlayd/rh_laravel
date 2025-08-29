// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var meses = ['domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado'];

// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_ferias')) listar();
    $('.btnAdd').addClass('d-none');
});

function listar() {
    $.ajax({
        url: url + '/listar',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_ferias').html(result);
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
}

function showFerias(mes) {
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
        $('.btnAdd').removeClass('d-none');
        $('.acoes').removeClass('d-none');
        $('.noAcoes').addClass('d-none');
    } else {
        $('.mes').addClass('d-none');
        $('.btnAdd').addClass('d-none');
        $('.acoes').addClass('d-none');
        $('.noAcoes').removeClass('d-none');
        $('.mes'+mes).removeClass('d-none');
    }    
}

function calcData(dias) {
    var inicio = $('#dataInicio').val();
    if(dias.length>=2){
        var fimDate = new Date(inicio).getTime() + dias*(1000*3600*24);
        var d = new Date(fimDate);
        var dia = ("0" + d.getDate()).slice(-2);
        var diaSemana = d.getDay();
        var mes = ("0" + (d.getMonth()+1)).slice(-2);
        var ano = d.getFullYear();
        var feriado = '';
        console.log(baseUrl + 'feriado/mostrar/'+dia+'/'+mes+'/'+ano);
        $.ajax({
            url: baseUrl + 'feriado/mostrar/'+dia+'/'+mes+'/'+ano,
            method: 'GET',
            dataType: 'html',
            success: function (result) {
                console.log(result);
                $('#txtTerminoFerias').html(dia+'/'+mes+'/'+ano+' '+meses[diaSemana]+' '+result);
            }
        });
    }
}
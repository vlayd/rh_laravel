$('#tabMesAtual').on('click', function () {
    showMes('pMesAtual', 'listaMesAtual', 'pMesSeguinte','listaMesSeguinte', 'pMesAnterior', 'listaMesAnterior');
});
$('#tabMesSeguinte').on('click', function () {
    showMes('pMesSeguinte', 'listaMesSeguinte', 'pMesAtual','listaMesAtual', 'pMesAnterior', 'listaMesAnterior');
});
$('#tabMesAnterior').on('click', function () {
    showMes('pMesAnterior', 'listaMesAnterior', 'pMesAtual','listaMesSeguinte', 'pMesSeguinte', 'listaMesAtual');
});

function showMes(mes) {
    $('.aniversarios').addClass("d-none");
    $('.mes'+mes).removeClass("d-none");
    return;
}
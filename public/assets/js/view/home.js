$('.tabMes').on('click', function () {
    showMes($(this).data('mes'));
});

function showMes(mes) {
    console.log(mes);    
    $('.mes').addClass("d-none");
    $('.mes'+mes).removeClass("d-none");
    return;
}
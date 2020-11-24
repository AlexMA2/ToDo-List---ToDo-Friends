$(function () {

$(".btn-editar").on("click", function(){
    $("#overlay").addClass('active');
    $("#popup").addClass('active');
});

$(".btn-cerrar-popup").on("click", function (event) {
    event.preventDefault();
    let x = event.target;
    if (x.nodeName === 'I' || x.nodeName === 'A') {
        $("#overlay").removeClass('active');
        $("#popup").removeClass('active');
    }
});

});
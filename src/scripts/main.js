$(document).ready(function () {
    var btnBurger = $(".btn-burger");

    btnBurger.click(function () {
        $(".mynav").toggleClass("menu-activo");
    });

    $(window).resize(function () {
        if ($(window).width() <= 767) {
            $(".cabecera").removeClass("row");
        }
        else{
            $(".cabecera").addClass("row");
        }

    })


});
$(document).ready(function () {
    var btnBurger = $(".btn-burger");

    btnBurger.click(function () {
        $(".mynav").toggleClass("menu-activo");
    });
});
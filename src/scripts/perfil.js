$(function () {
    
    $("#btn-perfil-foto").on("click", function(){        
        $(".perfil-foto form").animate({height: "20%"}, 200);
        
        $("#para-animar").fadeIn(1000);
    });    

    $(".btn-eliminar-cuenta").on('click', function(){
        $("#overlay").addClass("active");
        $("#popup").addClass("active");
    });

});
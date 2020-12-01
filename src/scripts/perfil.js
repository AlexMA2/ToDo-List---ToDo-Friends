$(function () {
    
    $("#btn-perfil-foto").on("click", function(){        
        $(".perfil-foto form").animate({height: "20%"}, 200);
        
        $("#para-animar").fadeIn(1000);
    });    

});
$(function(){
    $("#btn-perfil-nombre").on("click", function(){
        
        $("#in-perfil-nombre").removeAttr("disabled").focus();
        $(this).attr("type", "submit");
    });

    $("#btn-perfil-correo").on("click", function(){
        
        $("#in-perfil-correo").removeAttr("disabled").focus();
    });
    
});
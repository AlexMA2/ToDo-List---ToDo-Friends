$(function(){
    var id;
    $(".btn-editar").on("click", function(ev){
        ev.preventDefault();
        $("#overlay").addClass("active");
        $("#popup").addClass("active");
        let x = ev.target;        
        if (x.nodeName === 'A') {
            id = x.id;
            id = id.substring(2, id.length);
        }
        else if(x.nodeName === 'I'){
            id = x.id;
            id = id.substring(3, id.length);
        }
        
    });
    $(".btn-cerrar-popup").on("click",function(){
        $("#overlay").removeClass("active");
        $("#popup").removeClass("active");
    });

    $(".btn-config").on("click", function(){
        let urlActual = $('#formEditarTarea').attr('action');     
        
        $('#formEditarTarea').attr('action', urlActual + "?id=" + id);       
        $('#formEditarTarea').submit();
    });

});
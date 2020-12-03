$(function(){
    var id;
    $(".btn-opciones").on("click", function(ev){
        ev.preventDefault();
        $("#overlay").addClass("active");
        $("#popup").addClass("active");
        id = $(this).data("tid");
        let titulo = $(this).parent().parent().siblings("td:nth-child(1)").text();
        let descripcion = $(this).parent().parent().siblings("td:nth-child(2)").text();
        let fechaLimite = $(this).parent().parent().siblings("td:nth-child(3)").text();        
        $("#inEditTitulo").val(titulo);
        $("#inEditDesc").text(descripcion);
        $("#inEditFecha").val(fechaLimite);
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

    $(".btn-eliminar").on("click", function(){
        
        let urlActual = $(this).attr('href');
        $(this).attr('href', urlActual + "?id=" + id);
        

    });

    $(".btn-archivar").on("click", function(){
        
        let urlActual = $(this).attr('href');
        $(this).attr('href', urlActual + "?id=" + id);
        

    });

});
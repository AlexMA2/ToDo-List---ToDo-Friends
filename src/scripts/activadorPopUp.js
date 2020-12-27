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
        
        $('#formEditarTarea').attr('action', urlActual + "&id=" + id);       
        $('#formEditarTarea').submit();
    });

    $(".btn-eliminar").on("click", function(){
        
        let urlActual = $(this).attr('href');
        $(this).attr('href', urlActual + "&id=" + id);
        

    });

    $(".btn-archivar").on("click", function(){
        
        let urlActual = $(this).attr('href');
        $(this).attr('href', urlActual + "&id=" + id);
        

    });

    $(".desplegador").on("click", function(){
        let valor = $(this).parent().siblings(".desplegable").css("display");
        if(valor === "block"){
            $(this).parent().siblings(".desplegable").css("display","none");
            $(this).parent().siblings(".desplegable").slideUp();
            $(this).removeClass("fa-angle-down");
            $(this).addClass("fa-angle-left");
        }else{
            $(this).parent().siblings(".desplegable").css("display","block");
            $(this).removeClass("fa-angle-left");
            $(this).addClass("fa-angle-down");
        }
        
    });

    var chiquito = false;

    $(".pushmen").on("click", function(){
        let a = $(".nav-arbol-hoja a");
        let desplegador = $(".desplegador");
        let desplegable = $(".desplegable li a");
        if(a.css("display") === "block" && desplegador.css("display") === "block"){
            a.css("display", "none");
            desplegador.css("display", "none");
            desplegable.css("display", "none");
        }
        else{
            a.css("display", "block");
            desplegador.css("display", "block");
            desplegable.css("display", "block");
        }
        chiquito = !chiquito;       
        
    });    

    $(".main-sidebar").on("mouseover", function(){
        let a = $(".nav-arbol-hoja a");
        let desplegador = $(".desplegador");
        let desplegable = $(".desplegable li a");
        if(chiquito){
            a.css("display", "block");
            desplegador.css("display", "block");
            desplegable.css("display", "block");
        }
        
    });

    $(".main-sidebar").on("mouseout", function(){
        let a = $(".nav-arbol-hoja a");
        let desplegador = $(".desplegador");
        let desplegable = $(".desplegable li a");
        if(chiquito){
            a.css("display", "none");
            desplegador.css("display", "none");
            desplegable.css("display", "none");
        }
        
    })


});
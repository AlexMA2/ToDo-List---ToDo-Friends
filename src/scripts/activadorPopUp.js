$(function () {
    var id;

    $(".btn-opciones").on("click", function (ev) {
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
    $(".btn-cerrar-popup").on("click", function () {
        $("#overlay").removeClass("active");
        $("#popup").removeClass("active");
    });

    function getAbsolutePath() {       
        var loc = window.location;
        var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
        return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
    }

    const ruta = getAbsolutePath();

    //Ajax con las tareas

    $(".btn-guardar").on("click", function () {


        let inTitulo = $("#inTitulo").val();
        let inDesc = $("#inDesc").val();
        let inFecha = $("#inFecha").val();

        $.ajax({
            url: 'guardartarea.php',
            type: 'POST',
            data: "titulo=" + inTitulo + "&descripcion=" + inDesc + "&fecha=" + inFecha,
            success: function (rpt) {
                console.log(rpt);
                //window.location.replace(ruta + "TareasGrupales");
            }
        });

    });

    $(".btn-editar").on("click", function () {

        if (id !== undefined) {
            let inEditTitulo = $("#inEditTitulo").val();
            let inEditDesc = $("#inEditDesc").val();
            let inEditFecha = $("#inEditFecha").val();
            $.ajax({
                url: 'graneditar.php',
                type: 'POST',
                data: "idTarea=" + id + "&titulo2=" + inEditTitulo + "&descripcion2=" + inEditDesc + "&fecha2=" + inEditFecha,
                success: function (rpt) {

                    window.location.replace(ruta + "TareasGrupales");
                }
            });
        }
    });

    $(".btn-eliminar").on("click", function () {
        if (id !== undefined) {
            $.ajax({
                url: 'eliminartarea.php',
                type: 'POST',
                data: 'idTarea=' + id,
                success: function (rpt) {
                    window.location.replace(ruta + "TareasGrupales");
                }
            });
        }

    });

    $(".btn-archivar").on("click", function () {
        if (id !== undefined) {
            $.ajax({
                url: 'archivartareas.php',
                type: 'POST',
                data: 'idTarea=' + id,
                success: function (rpt) {
                    window.location.replace(ruta + "TareasGrupales");
                }
            });
        }
    });

    $("#r1").on("click", function() {
        $.ajax({
            url: 'estadoTarea.php',
            type: 'POST',
            data: "valor=1&idTarea=" + id,
            success: function (rpt) {
                console.log(rpt);
            }
        });      
    });

    $("#r2").on("click", function() {
        $.ajax({
            url: 'estadoTarea.php',
            type: 'POST',
            data: "valor=2&idTarea=" + id,
            success: function (rpt) {
                console.log(rpt);
            }
        });      
    });

    $("#r3").on("click", function() {
        $.ajax({
            url: 'estadoTarea.php',
            type: 'POST',
            data: "valor=3&idTarea=" + id,
            success: function (rpt) {
                console.log(rpt);
            }
        });      
    });


    //Ajax con temas

    $(".btn-editar-tema").on("click", function () {
        if (id1 !== undefined) {
            let editTemaTitulo = $("#editTemaTitulo").val();
            let editTemaDesc = $("#editTemaDesc").val();
            console.log(id1 + " xdxdxd ");
            $.ajax({
                url: 'editarTema.php',
                type: 'POST',
                data: "IDTEMA=" + id1 + "&Titulo4=" + editTemaTitulo + "&Descripcion4=" + editTemaDesc,
                success: function (rpt) {
                    window.location.replace(ruta + "NetWork");
                }
            });
        }
    });

    $(".btn-eliminar-tema").on("click", function () {
        let id = $(this).attr("id");
        if (id !== undefined) {
            $.ajax({
                url: 'eliminarTema.php',
                type: 'POST',
                data: 'IDTEMA=' + id,
                success: function (rpt) {
                    window.location.replace(ruta + "NetWork");
                }
            });
        }

    });

    $("#btn-crear-tema").on("click", function(){
        let tit = $("#inTemaTitulo").val();
        let desc = $("#inTemaDesc").val();
        $.ajax({
            url: 'CrearTema.php',
            type: 'POST',
            data: 'Titulo3=' + tit + '&Descripcion3=' + desc,
            success: function (rpt) {                
                console.log(rpt);
                if(rpt === "Aceptado"){
                    window.location.replace(ruta + "NetWork");
                }
                else{
                    console.log(rpt);
                }
            }
        });
    });

    $(".btn-ver-tema").on('click', function () {
        const idTema = $(this).attr('id');
        setTema(idTema, 'tema');
    });

    //Ajax con temas grupales

    $("#btn-crear-temagrupal").on("click", function(){
        let tit = $("#inTemaTitulo").val();
        let desc = $("#inTemaDesc").val();
        $.ajax({
            url: 'CrearTema.php',
            type: 'POST',
            data: 'Titulo3=' + tit + '&Descripcion3=' + desc,
            success: function (rpt) {
                window.location.replace(ruta + "NetWorkGrupal");
            }
        });
    });   

    //Funciones de la barra principal

    $(".btn-guardar").on("click", function () {


        let inTitulo = $("#inTitulo").val();
        let inDesc = $("#inDesc").val();
        let inFecha = $("#inFecha").val();

        $.ajax({
            url: 'guardartarea.php',
            type: 'POST',
            data: "titulo=" + inTitulo + "&descripcion=" + inDesc + "&fecha=" + inFecha,
            success: function (rpt) {
                //console.log(rpt);
                window.location.replace(ruta + "TareasGrupales");
            }
        });

    });

    $(".desplegador").on("click", function () {
        let valor = $(this).parent().siblings(".desplegable").css("display");
        if (valor === "block") {
            $(this).parent().siblings(".desplegable").css("display", "none");
            $(this).parent().siblings(".desplegable").slideUp();
            $(this).removeClass("fa-angle-down");
            $(this).addClass("fa-angle-left");
        } else {
            $(this).parent().siblings(".desplegable").css("display", "block");
            $(this).removeClass("fa-angle-left");
            $(this).addClass("fa-angle-down");
        }

    });

    var chiquito = false;

    $(".pushmen").on("click", function () {
        let a = $(".nav-arbol-hoja a");
        let desplegador = $(".desplegador");
        let desplegable = $(".desplegable li a");
        if (a.css("display") === "block" && desplegador.css("display") === "block") {
            a.css("display", "none");
            desplegador.css("display", "none");
            desplegable.css("display", "none");
        }
        else {
            a.css("display", "block");
            desplegador.css("display", "block");
            desplegable.css("display", "block");
        }
        chiquito = !chiquito;

    });

    $(".main-sidebar").on("mouseover", function () {
        let a = $(".nav-arbol-hoja a");
        let desplegador = $(".desplegador");
        let desplegable = $(".desplegable li a");
        if (chiquito) {
            a.css("display", "block");
            desplegador.css("display", "block");
            desplegable.css("display", "block");
        }

    });

    $(".main-sidebar").on("mouseout", function () {
        let a = $(".nav-arbol-hoja a");
        let desplegador = $(".desplegador");
        let desplegable = $(".desplegable li a");
        if (chiquito) {
            a.css("display", "none");
            desplegador.css("display", "none");
            desplegable.css("display", "none");
        }

    });

    // Ajax con grupos
    

    $(".btn-ver-grupo").on('click', function () {
        let idGrupo = $(this).attr('id');
        idGrupo = parseInt(idGrupo.substring(4));
        setTema(idGrupo, 'grupo');
    });

    $(".btn-crear-grupo").on('click', function(){
        let tit = $("#inGrupoTitulo").val();
        let desc = $("#inGrupoDesc").val();

        $.ajax({
            url: 'crearGrupo.php',
            type: 'POST',
            data: 'Titulo4=' + tit + '&Descripcion4=' + desc,
            success: function(rpt){
                if(rpt === "Aceptado"){
                    window.location.replace(ruta + "MisEquipos");
                }
                else{
                    console.log(rpt);
                }
            }
        });

    });

    $(".btn-eliminar-migrupo").on('click', function () {
        
        let idGrupo = $(this).attr('id');
        idGrupo = parseInt(idGrupo.substring(4));
        let unidadGrupo = $(this).parent().parent();
        $.ajax({
            url: 'eliminarGrupo.php',
            type: 'POST',
            data: 'idGrupo=' + idGrupo,
            success: function(rpt){
                unidadGrupo.remove();
            } 
           
        });

    });

    function setTema(id, variable) {
        $.ajax({
            url: 'colocarVariable.php',
            type: 'POST',
            data: 'idVar=' + id + "&variable=" + variable,
            success: function (rpt) {
                if (variable == "tema") {
                    window.location.replace(ruta + "TareasGrupales");
                }
                else if (variable == "grupo") {
                    window.location.replace(ruta + "NetWorkGrupal");
                }
            }
        });
    }
    // ESTO ES UNA PRUEBA PARA VERIFICAR SI RENZO TRABAJO

});
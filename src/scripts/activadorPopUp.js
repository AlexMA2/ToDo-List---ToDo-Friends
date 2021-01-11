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

    })

    $(".btn-ver-tema").on('click', function () {
        const idTema = $(this).attr('id');
        setTema(idTema, 'tema');
    });

    $(".btn-ver-grupo").on('click', function () {
        const idGrupo = $(this).attr('id');
        setTema(idGrupo, 'grupo');
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

});
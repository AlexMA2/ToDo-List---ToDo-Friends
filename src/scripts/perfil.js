$(function () {
    var id;
    $("#btn-perfil-foto").on("click", function () {
        $(".perfil-foto form").animate({ height: "20%" }, 200);

        $("#para-animar").fadeIn(1000);
    });

    $(".btn-eliminar-cuenta").on('click', function () {
        id = $(this).parent().siblings("td:nth-child(1)").text();
        $("#overlay").addClass("active");
        $("#popup").addClass("active");
    });

    $(".btn-eliminar-grupo").on('click', function () {
        id = $(this).parent().siblings("td:nth-child(1)").text();
        $("#overlaygrupo").addClass("active");
        $("#popupgrupo").addClass("active");
    });

    $(".btn-eliminar-micuenta").on('click', function () {
        $("#overlay").addClass("active");
        $("#popup").addClass("active");
    });

    $(".confirmar-eliminar-cuenta").on('click', function () {
        if (id !== undefined) {
            let razon = $("#razon-ban").val();
            let tiempo = $("#tiempo-ban").val();
            $.ajax({
                url: 'borrarCuenta.php',
                type: 'POST',
                data: 'iduser=' + id + "&razon=" + razon + "&tiempo=" + tiempo,
                success: function (rpt) {
                    console.log(rpt);
                    if(rpt === "Aceptado"){
                        $("#" + id).empty();
                        $("#overlay").removeClass("active");
                        $("#popup").removeClass("active");
                    }                    

                }

            });
        }


    });


    $(".confirmar-eliminar-grupo").on('click', function () {
        if (id !== undefined) {
            console.log(id);
            $.ajax({
                url: 'borrarGrupo.php',
                type: 'POST',
                data: 'IDGRUPO=' + id,
                success: function () {
                    $("#" + id).empty();
                    $("#overlaygrupo").removeClass("active");
                    $("#popupgrupo").removeClass("active");

                }

            });
        }


    });

    $(".confirmar-eliminar-micuenta").on('click', function () {
        $.ajax({
            url: 'borrarCuenta.php',
            type: 'POST',
            data: 'iduser=-1',
            success: function () {                
                if (location.hostname === "localhost" || location.hostname === "127.0.0.1"){
                    window.location.replace("http://localhost/ToDo-List---ToDo-Friends/");                   
                }
                else{
                    window.location.replace("https://todolist-todofriends.herokuapp.com/");
                }               
            }

        });
    });

});
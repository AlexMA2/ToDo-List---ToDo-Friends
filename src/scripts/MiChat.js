$(function () {

    let contadorMensajes = 0;

    function AgregarItem(mensaje) {
        contadorMensajes += 1;
        notificarChat();
        $(".itemtemplate").clone().appendTo(".chatpluginchat");
        $('.chatpluginchat .itemtemplate').show(10);        
        $('.chatpluginchat .itemtemplate #Contenido').html(mensaje);

        var formattedDate = new Date();
        var d = formattedDate.getUTCDate();
        var m = formattedDate.getMonth();
        var y = formattedDate.getFullYear();
        var h = formattedDate.getHours();
        var min = formattedDate.getMinutes();

        Fecha = d + "/" + m + "/" + y + " " + h + ":" + min;

        $('.chatpluginchat .itemtemplate #Tiempo').html(Fecha);
        $('.chatpluginchat .itemtemplate').removeClass("itemtemplate");

    }

    $("#minimizar-chat").on('click', function (ev) {
        ev.preventDefault();
        if ($(this).hasClass("fa-minus")) {
            $("#Michat").hide();
            $(".btn-chat").show();
        }

    });

    $(".btn-chat").on('click', function () {
        $(this).hide();
        $("#Michat").show();
    });

    function notificarChat() {
        if (contadorMensajes > 0 && $(".btn-chat").css("display") !== "none") {
            $(".notificaciones").css("visibility", "visible");
            $(".notificaciones").text(contadorMensajes);
        }
        else if ($(".btn-chat").css("display") === "none") {
            contadorMensajes = 0;
        }
    }

    $("#txtMensaje").keyup(function (e) {
        if (e.keyCode == 13) {
            EnviarMensaje();
        }
    });

    $("#btnEnviar").click(function () {
        EnviarMensaje();
    });

    function EnviarMensaje() {
        let mensaje = $("#txtMensaje").val();
        mensaje = mensaje.trim();
        $("#txtMensaje").val('');
        if(mensaje.length > 0){
            $.ajax({
                
            });
            AgregarItem(mensaje);
        }
    }

})
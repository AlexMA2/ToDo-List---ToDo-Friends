$(function () {

    let contadorMensajes = 0;
    actualizar();

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
        contadorMensajes = 0;
        notificarChat();
        //$(".chatpluginchat").animate({ scrollTop: $(this).prop("scrollHeight")}, 1000);
    });

    function notificarChat() {
        if (contadorMensajes > 0 && $(".btn-chat").css("display") !== "none") {
            $(".notificaciones").css("visibility", "visible");
            $(".notificaciones").text(contadorMensajes);
        }
        else if ($(".btn-chat").css("display") === "none") {
            $(".notificaciones").css("visibility", "hidden");
            contadorMensajes = 0;
            $(".notificaciones").text(contadorMensajes);
            
        }
    }

    $("#txtMensaje").keyup(function (e) {
        if (e.keyCode == 13) {
            let grup = $('.btn-chat').attr('id');
            $("emoji-picker").css("display", "none");
            EnviarMensaje(grup);
        }
    });

    $("#btnEnviar").click(function () {
        let grup = $('.btn-chat').attr('id');
        $("emoji-picker").css("display", "none");
        EnviarMensaje(grup);
    });

    function EnviarMensaje(grup) {
        let mensaje = $("#txtMensaje").val();
        mensaje = mensaje.trim();
        $("#txtMensaje").val('');
        if (mensaje.length > 0) {
            $.ajax({
                url: 'mensajes.php',
                type: 'post',
                data: "do=enviar&msj=" + mensaje,
                success: function (rpt) {
                    actualizar();
                }
            });

        }
    }

    let primeraVez = true;

    function actualizar() {
        const longitud = $(".chatpluginchat li").length;

        $.ajax({
            url: 'mensajes.php',
            type: 'POST',
            data: 'do=actualizar&length=' + longitud,
            success: function (rpt) {               
                if (rpt !== "NO") {                   
                    let otro = JSON.parse(rpt);
                    if (rpt !== null) {
                        if (rpt.length > 0) {
                            otro.forEach(element => {
                                actualizarItems(element['mensaje'], element['fecha'], element['nombre'], element['foto']);
                            });
                        }
                    }
                }
                else{
                    primeraVez = false;
                }

            }
        });
    }

    function actualizarItems(mensaje, fecha, nombre, foto) {
        if(primeraVez === false){
            contadorMensajes += 1;
            notificarChat();
            
        }        
        //$(".chatpluginchat").animate({ scrollTop: $('.chatpluginchat')[0].scrollHeight}, 1000);

        $(".itemtemplate").clone().appendTo(".chatpluginchat");
        $('.chatpluginchat .itemtemplate').show(10);
        $('.chatpluginchat .itemtemplate #Contenido').html(mensaje);
        $('.chatpluginchat .itemtemplate #Nombre').html(nombre);
        $('.chatpluginchat .itemtemplate #Foto').attr('src', foto);
        $('.chatpluginchat .itemtemplate #Tiempo').html(fecha);
        $('.chatpluginchat .itemtemplate').removeClass("itemtemplate");
    }

    const tiempo = 1000*60*60;

    function basurero(){
        $.ajax({
            url: 'mensajes.php',
            type: 'POST',
            data: 'do=eliminar',
            success: function (rpt) {                
                actualizar();
                $(".chatpluginchat").empty();
            }
        });

    }

    setInterval(actualizar, 500);

    setInterval(basurero, tiempo);

    $(".emojis i").on('click', function(){
        if($("emoji-picker").css("display") === "none"){
            $("emoji-picker").css("display", "block");
        }
        else{
            $("emoji-picker").css("display", "none");
        }
        
    });

    document.querySelector('emoji-picker').addEventListener('emoji-click', event => escribirEmoji(event.detail.emoji.unicode));

    function escribirEmoji(emoticono){
        $("#txtMensaje").val($("#txtMensaje").val() + emoticono);
    }

})
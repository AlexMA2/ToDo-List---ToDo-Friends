$.fn.extend({
  ChatSocket: function (opciones) {
    var ChatSocket = this;

    var idChat = $(ChatSocket).attr('id');
    defaults = {
      ws,
      Room: "SalaTodoFriends",
      pass: "1234",
      lblTitulChat: " Chat Develoteca.com ",
      lblCampoEntrada: "Menssage",
      lblEnviar: "Send",
      textoAyuda: "Develoteca",
      Nombre: "Anónimo",

      urlImg: "http://placehold.it/50/55C1E7/fff&text=U",
      btnEntrar: "btnEntrar",
      btnEnviar: "btnEnviar",
      lblBtnEnviar: "Enviar",
      lblTxtEntrar: "txtEntrar",
      lblTxtEnviar: "txtMensaje",
      lblBtnEntrar: "Enter",
      idDialogo: "DialogoEntrada",
      classChat: "",
      idOnline: "ListaOnline",
      lblUsuariosOnline: "Users joined",
      lblEntradaNombre: "Name:",
      panelColor: "success",
      elnombre: ""
    }

    var opciones = $.extend({}, defaults, opciones);

    var ws;
    var Room = opciones.Room;
    var pass = opciones.pass;
    var lblTitulChat = opciones.lblTitulChat;
    var lblCampoEntrada = opciones.lblCampoEntrada;
    var lblEnviar = opciones.lblBtnEnviar;
    var textoAyuda = opciones.textoAyuda;
    var Nombre = opciones.Nombre;

    var urlImg = opciones.urlImg;
    var btnEntrar = opciones.btnEntrar;
    var btnEnviar = opciones.btnEnviar;
    var lblBtnEnviar = opciones.lblBtnEnviar;
    var lblTxtEntrar = opciones.lblTxtEntrar;
    var lblTxtEnviar = opciones.lblTxtEnviar;
    var lblBtnEntrar = opciones.lblBtnEntrar;
    var idDialogo = opciones.idDialogo;
    var classChat = opciones.classChat;
    var idOnline = opciones.idOnline;
    var lblUsuariosOnline = opciones.lblUsuariosOnline;
    var lblEntradaNombre = opciones.lblEntradaNombre;
    var panelColor = opciones.panelColor;
    if ($('#' + idOnline).length == 0) {
      idOnline = idChat + "listaOnline";
      let opcChat = "<div class='opciones-chat'><i class='fas fa-minus' id='minimizar-chat'></i></div>";
      $('#' + idChat).append(opcChat);
      $('#' + idChat).append('<br/><div id="' + idOnline + '"></div>');
    }



    function IniciarConexion() {
      conex = '{"setID":"' + Room + '","passwd":"' + pass + '"}';
      ws = new WebSocket("wss://achex.ca:4010.herokuapp.com/");
      ws.onopen = function () {
        ws.send(conex);
        const PING_TIME = 25;

        // Función que hace un ping (el parámetro es un callback vacío)
        const ping = () => ws.ping(() => { });

        // Establecer la ejecución periódica del ping. Para cancelar, utilizar clearInterval
        setInterval(ping, PING_TIME * 1000);
      }
      ws.onmessage = function (Mensajes) {
        var MensajesObtenidos = Mensajes.data;
        var obj = jQuery.parseJSON(MensajesObtenidos);
        AgregarItem(obj);

        if (obj.sID != null) {


          if ($('#' + obj.sID).length == 0) {

            $('#listaOnline').append('<li class="list-group-item" id="' + obj.sID + '"><span class="label label-success">&#9679;</span> - ' + obj.Nombre + '</li>');

          }

        }

      }
      ws.onclose = function (ev) {
        console.log("Conexión cerrada", ev.code);
      }

      ws.onerror = function(event) {
        console.log("WebSocket error observed:", event);
      }
    }
    IniciarConexion();
    function iniciarChat() {

      //Nombre = $('#' + lblTxtEntrar).val();     
      Nombre = opciones.elnombre;

      $('#' + idDialogo).hide();
      $('#' + idOnline).show();

      $(".opciones-chat").css("display", "block");
      CrearChat();
      UsuarioOnline();
      getOnline();
    }

    //idChat = DialogoEntrada
    // idOnline = ElchatlistaOnline

    function CrearEntrada() {

      $('#' + idChat).append('<div id="' + idDialogo + '" class="' + classChat + '" id="InputNombre"><div class="panel-footer" style="margin-top:100px;"><div class="input-group"><span class="input-group-btn"><button id="' + btnEntrar + '" class="btn btn-success btn-sm" >' + lblBtnEntrar + '</button></span></div></div></div>');
      $('#' + idOnline).append(' <div class="panel panel-' + panelColor + '"><div class="panel-body"><ul class="list-group" id="listaOnline"></ul></div><div class="panel-footer"><div class="input-group"><div></div></span></div></div></div>');

      $("#" + lblTxtEntrar).keyup(function (e) {
        if (e.keyCode == 13) {
          console.log("Iniciando chat");
          iniciarChat();
        }
      });
      $("#" + btnEntrar).click(function () {
        console.log("Iniciando chat");
        iniciarChat();
      });

    }
    function CrearChat() {
      $('#' + idChat).append('<div class="' + classChat + ' cuerpo-chat"><div class="panel panel-' + panelColor + '"><div class="panel-body"><ul class="chatpluginchat"></ul></div><div class="panel-footer"><div class="input-group"><input id="'
        + lblTxtEnviar + '" type="text" class="form-control input-sm" placeholder="' + lblCampoEntrada + '" /><span class="input-group-btn"><button  class="btn btn-warning btn-sm" id="' + btnEnviar + '">' + lblEnviar + '</button></span></div></div></div></div><li class="left clearfix itemtemplate" style="display:none"><span class="chat-img pull-left"><img src="' + urlImg + '" alt="User Avatar" class="img-circle" id="Foto"/></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font" id="Nombre">Nombre</strong><small class="pull-right text-muted"><span class="glyphicon glyphicon-asterisk"></span><span id="Tiempo">12 mins ago</span></small></div> <p id="Contenido">Contenido</p></div></li>');

      $("#" + lblTxtEnviar).keyup(function (e) { if (e.keyCode == 13) { EnviarMensaje(); } });
      $("#" + btnEnviar).click(function () { EnviarMensaje(); });

    }

    function EnviarMensaje() {
      ws.send('{"to":"' + Room + '","Nombre":"' + Nombre + '","Contenido":"' + $('#' + lblTxtEnviar).val() + '"}');
      $("#" + lblTxtEnviar).val('');

    };
    function UsuarioOnline() {
      ws.send('{"to":"' + Room + '","Nombre":"' + Nombre + '"}');
    }
    function AgregarItem(Obj) {

      if ((Obj.Contenido != null) && (Obj.Nombre != null)) {

        $(".itemtemplate").clone().appendTo(".chatpluginchat");
        $('.chatpluginchat .itemtemplate').show(10);
        $('.chatpluginchat .itemtemplate #Nombre').html(Obj.Nombre);
        $('.chatpluginchat .itemtemplate #Contenido').html(Obj.Contenido);

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
    }
    function getOnline() {
      setInterval(UsuarioOnline, 3000);
    }


    CrearEntrada();
    // Fin


    $("#minimizar-chat").on('click', function (ev) {
      ev.preventDefault();
      if ($(this).hasClass("fa-minus")) {
        $(".cuerpo-chat").css("display", "none");
        $("#ElchatlistaOnline").css("display", "none");
        $("#Elchat").css("top", "90%");
        $(this).removeClass("fa-minus");
        $(this).addClass("fa-plus");

      }
      else {
        $("#Elchat").css("top", "75%");
        $(".cuerpo-chat").css("display", "block");
        $("#ElchatlistaOnline").css("display", "block");
        $(this).removeClass("fa-plus");
        $(this).addClass("fa-minus");

      }

    });
  }
});

<?php
    session_start();
    require "conexion.php";           
    if(empty($_SESSION['user'])){
        header("location:../..");
    }
    else{
        require "sacarDatos.php";               
        list ($uID, $uNombre, $uCorreo, $uFoto) = getInfoSobre($_SESSION['user']);
    }
    $query = "SELECT * FROM temas WHERE Grupo = :id";
    $resultado_tema = $conection->prepare($query);
    $resultado_tema->bindValue(":id", $_SESSION['grupo']);
    $resultado_tema->execute();
    list ($gID, $gNombre, $gDesc, $gDueno) = getInfoSobreGrupo($_SESSION['grupo']);
    list($uID5, $uNombre5, $uCorreo5, $uFoto5)= getInfoSobre($gDueno);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Esta aplicacion fue creada para ayudar a una persona o a un grupo a orgnizar sus tareas.">
    <meta name="author"
        content="Gianela Mallqui, Alex Mamani, Nestor Soto, Renzo Marcos, Martin Rodriguez y Brayan Oroncuy">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../../res/favicon1.png" type="image/x-icon">
    <title>Todo List | Empieza a organizarte</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../styles/netWork.css">
    <link rel="stylesheet" href="../styles/editar.css">

    <link rel="stylesheet" href="../styles/chat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">


        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pushmen" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">

                </li>
            </ul>


            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Buscar"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="#" class="brand-link">
                <img src="../../res/favicon1.png" alt="Todo List" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Todo List</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php print_r($uFoto)?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="perfilusuario" class="d-block">
                            <?php        
                                                     
                                print_r($uNombre);
                            ?>
                        </a>
                    </div>
                </div>

                <nav class="mt-2">
                   
                    <ul class="nav-arbol">
                        <li class="nav-li">
                            <div class="nav-arbol-hoja">
                                <i class="fas fa-table"></i>
                                <a href="NetWork"> Tablero </a>
                                <i class="fas fa-angle-left right desplegador"></i>
                            </div>
                            <ul class="nav desplegable">
                                <li>
                                    <i class="far fa-circle nav-icon"></i>
                                    <a href="#" class="text-truncate">PrimeroPrimeroP(19)</a>
                                </li>
                                <li>
                                    <i class="far fa-circle nav-icon"></i>
                                    <a href="#" class="text-truncate">Primero</a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-li">
                            <div class="nav-arbol-hoja">
                                <i class="fas fa-users"></i>
                                <a href="misequipos"> Mis equipos </a>
                                <i class="fas fa-angle-left right desplegador"></i>
                            </div>
                            <ul class="nav desplegable">
                                <li>
                                    <i class="far fa-circle nav-icon"></i>
                                    <a href="#">PrimeroPrimeroP(19)</a>
                                </li>
                                <li>
                                    <i class="far fa-circle nav-icon"></i>
                                    <a href="#">Primero</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <div class="nav-arbol-hoja">
                                <i class="fas fa-door-open"></i>
                                <a href="../../"> Salir </a>

                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="overlay " id="overlay">
                        <div class="popup " id="popup">

                            <div class="col sm-4">
                                <a href="#" class=" btn-cerrar-popup"><i class="far fa-times-circle"></i></a>
                                <div class="row">
                                    <div class="card card-body col-12">

                                        <form
                                            action="CrearTema.php?grupo=<?php print_r(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))?>"
                                            method="POST" id="CTema">
                                            <div class="form-group">
                                                <input type="text" name="Titulo3" maxlength="16" minlength="4"
                                                    class=" form-control" id="inTemaTitulo" placeholder=" Título">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="Descripcion3" maxlength="32" rows="4"
                                                    class="form-control" id="inTemaDesc"
                                                    placeholder="Descripcion"></textarea>
                                            </div>
                                            <input type="submit" class="btn btn-config btn-light btn-block"
                                                name="CrearTema" value="Crear Tema Grupal" />

                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 row">
                            <h1 class="m-0 text-dark"> Temas de Trabajo </h1>
                            <h3> &nbsp;( <?php print_r($resultado_tema->rowCount())?> )</h3>
                            <button class="btn-opciones btn btn-success mx-2"> Crear Tema </button>
                            <!--div class="color-picker"></div-->
                        </div>
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="NetWork"> Tablero </a></li>
                                <li class="breadcrumb-item active"> Tema </li>
                            </ol>
                        </div>



                    </div>
                </div>
                <div class="grupo-temas">

                    <?php                                           
                       
                        while($row = $resultado_tema->fetch(PDO::FETCH_ASSOC)) {                            
                        ?>

                    <div class="unidad-tema">
                        <div class="small-box bg-info miTema" id="tema-<?php print_r($row ["IDTEMA"]);?>">
                            <div class="inner">
                                <h3><?php print_r($row['Titulo']); ?></h3>

                                <p><?php print_r($row['Descripcion']); ?></p>
                            </div>

                            <a href="TareasGrupales" id="<?php print_r($row["IDTEMA"]);?>"
                                class="small-box-footer btn-ver-tema"> Ver
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>

                </div>


            </div>
            <!-- aqui comienza añadir integrante -->
        <div class="card card-body col-4">
            <table class="table table-bordered " class="display" id="mitabla">
            <h4> Intregantes</h4>
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre de usuario</th>
                        <?php
                            if($_SESSION['user']==$uID5){

                        ?>
                        <th>Accion</th>
                        <?php                                
                        }
                        ?>
                    </tr>
                </thead>
                <tbody class="lista-tareas">
                <tr>
                            <td><?php    print_r($uNombre5); ?></td>
                            <?php
                            if($_SESSION['user']==$uID5){

                            ?>
                            <td>
                                <!-- aqui pongan su wea-->
                                <i class="fas fa-minus-circle"></i> | 
                                <a style="text-decoration:none" class="btn btn-danger" href="eliminarIntegrante.php?IDdelete=<?php print_r($uID5);?>"><i class="fas fa-trash"></i> </a> 
                                </td>
                                <?php                                
                                }
                                ?>   
                </tr>                                     
                                                     
                                                 
                    <?php
                                           
                        if($_SESSION['grupo'] != 0){
                            $query = "SELECT * FROM otro_grupos WHERE FKgrupo = :grupo";
                            $resultado_tarea = $conection->prepare($query);
                            
                            $resultado_tarea->bindValue(":grupo", $_SESSION['grupo']);
                            $resultado_tarea->execute();
                            while($row = $resultado_tarea->fetch(PDO::FETCH_ASSOC)) {
                                list ($uID2, $uNombre2, $uCorreo2, $uFoto2) = getInfoSobre($row['FKusuario']);
                                $_SESSION['userDelete']=$uID2;
                                ?>

                                <tr class="item-tarea">
                                    <td><?php print_r($uNombre2); ?></td>
                                    <?php
                                    if($_SESSION['user']==$uID5){

                                    ?>
                                    <td>
                                    <!-- aqui pongan su wea-->
                                    <i class="fas fa-microphone"></i> |
                                    <i class="fas fa-microphone-slash"></i> | 
                                    <a style="text-decoration:none" class="btn btn-danger" href="eliminarIntegrante.php?IDdelete=<?php print_r($uID2);?>"><i class="fa fa-trash"></i> </a> 
                                    </td>
                                    <?php                                
                                    }
                                    ?>
                                </tr>
                            <?php 
                            }
                        }
                        else{
                        ?>
                        <script>
                            function getAbsolutePath() {
                                var loc = window.location;
                                var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
                                return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
                            }
                            window.location.replace(getAbsolutePath() + "misequipos");
                        </script>
                        <?php    
                        }
                    ?>
                </tbody>
            </table>

            <br>
            <?php
            if($_SESSION['user']==$uID5){

            ?>
            <div class="card card-body">

                <form action="agregarIntegrante.php" method="POST" id="guardarAmigo">


                    <p>Añadir integrantes</p>
                    <div class="form-group">
                        <input type="email" name="emailAmigo" class="form-control" id="idEmailAmigo"
                            placeholder="Escriba el correo a añadir">
                    </div>
                    <input type="submit" class="btn btn-config btn-light btn-block" name="btnAddAmigo"
                        value="Agregar integrante" />
                    <?php
                    if(empty($_SESSION['mensaje'])){
                    }else{
                        ?>
                        <h4 class="fs-2"><?php print_r($_SESSION['mensaje']);?></h4>
                    <?php
                    }

                    ?>
                </form>

            </div>
            <?php                                
            }
            ?>
        </div>
        <!-- aqui termina añadir contactos-->
            <div id="Elchat"></div>
        </div>
       
    </div>
    



    <footer class="main-footer">
        <strong> &copy; 2020 <a href="#">Todo List</a>.</strong>
        Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versi&oacute;n</b> 1.0
        </div>
    </footer>

    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="../../chatSocketAchex/chatSocketAchex.js"></script>
    <script>
    $('#Elchat').ChatSocket({
        elnombre: '<?php print_r($uNombre)?>',
        Room: '<?php print_r($gNombre . "-" . $gID)?>',
        lblTitulChat: " Chat Grupal ",
        lblCampoEntrada: "Escribe un mensaje...",
        lblEnviar: "Enviar",
        urlImg: '<?php print_r($uFoto)?>',
        btnEntrar: "btnEntrar",
        btnEnviar: "btnEnviar",
        lblBtnEnviar: "Enviar",
        lblTxtEntrar: "txtEntrar",
        lblTxtEnviar: "txtMensaje",
        lblBtnEntrar: "Entrar al chat",
        idDialogo: "DialogoEntrada",
        classChat: "chat-grupal-todo",
        idOnline: "ListaOnline",
        lblUsuariosOnline: "Usuarios Conectados",
        lblEntradaNombre: "Nombre:",
        panelColor: "success",
    });
    </script>

    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <script src="../../plugins/sparklines/sparkline.js"></script>
    <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../../dist/js/adminlte.js"></script>
    <script src="../../dist/js/demo.js"></script>
    <script src="../scripts/activadorPopUp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>


    <script>
    var laid = "tema";
    $(".miTema").on("click", function() {
        laid = $(this).attr("id");

    });
    var panel = document.getElementById(laid);
    const pickr = Pickr.create({
        el: '.color-picker',
        theme: 'classic', // or 'monolith', or 'nano'

        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 0.95)',
            'rgba(156, 39, 176, 0.9)',
            'rgba(103, 58, 183, 0.85)',
            'rgba(63, 81, 181, 0.8)',
            'rgba(33, 150, 243, 0.75)',
            'rgba(3, 169, 244, 0.7)',
            'rgba(0, 188, 212, 0.7)',
            'rgba(0, 150, 136, 0.75)',
            'rgba(76, 175, 80, 0.8)',
            'rgba(139, 195, 74, 0.85)',
            'rgba(205, 220, 57, 0.9)',
            'rgba(255, 235, 59, 0.95)',
            'rgba(255, 193, 7, 1)'
        ],

        components: {

            // Main components
            preview: true,
            opacity: true,
            hue: true,

            // Input / output Options
            interaction: {
                hex: true,
                rgba: false,
                hsla: false,
                hsva: false,
                cmyk: false,
                input: true,
                clear: true,
                save: true
            }
        }
    });

    pickr.on('change', (...args) => {
        let color = args[0].toRGBA();
        console.log(color);
        var color2 = `rgba(${color[0]}, ${color[1]}, ${color[2]}, ${color[3]})`
        $(panel).attr('style', 'background-color: ' + color2 + '!important');
    });
    </script>
</body>

</html>
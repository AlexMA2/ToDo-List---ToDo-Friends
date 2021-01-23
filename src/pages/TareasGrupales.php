<?php
    require "conexion.php";
    session_start();           
    
    if(empty($_SESSION['user']) || empty($_SESSION['tema']) ){
        header("location: ../..");
    }
    else{        
        require "sacarDatos.php";       
        list ($uID, $uNombre, $uCorreo, $uFoto) = getInfoSobre($_SESSION['user']);
    }
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
    <link rel="stylesheet" href="../styles/editar.css">
    <title>Todo List | Empieza a organizarte</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../styles/netWork.css">
    <link rel="stylesheet" href="../../plugins/datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../styles/chat.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>

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

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        Todo Friends
                        <i class="fas fa-check-circle"></i>
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
                        <img src="<?php print_r($uFoto)?>" alt="User Image" class="img-circle elevation-2">
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
                                <li class="text-wrap">
                                    <i class="far fa-circle nav-icon"></i>
                                    <a href="#" class="text-truncate">PrimeroPrimeroP(19)</a>
                                </li>
                                <li>
                                    <i class="far fa-circle nav-icon"></i>
                                    <a href="#">Primero</a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-li">
                            <div class="nav-arbol-hoja">
                                <i class="fas fa-users"></i>
                                <a href="MisEquipos"> Mis equipos </a>
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
                        <?php
                            if($_SESSION['nivel'] == 1){
                            ?>
                        <li class="nav-li">
                            <div class="nav-arbol-hoja">
                                <i class="fas fa-users-cog"></i>
                                <a href="panelAdmin"> Administrador </a>
                            </div>
                        </li>
                        <?php
                            }              
                                   
                        ?>
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

        <?php
            
            $tema = $_SESSION['tema'];
            
            if(empty($_SESSION['grupo'])){
                // Validar que el tema pertenece al usuario
                $otraQuery = "SELECT * FROM temas WHERE Usuario = :id AND IDTEMA = :tema";
                $esteResultado = $conection->prepare($otraQuery);
                $esteResultado->bindValue(":id",  $_SESSION['user']);
                $esteResultado->bindValue(":tema",  $tema);
                $esteResultado->execute();
                
                while($otrosDatos = $esteResultado->fetch(PDO::FETCH_ASSOC)){
                    $nombreTema = $otrosDatos['Titulo'];
                    $descripcionTema = $otrosDatos['Descripcion'];
                }

                $filas = $esteResultado->rowCount();
            }
            else{
                // Validar que el tema le pertenece al grupo
                $otraQuery = "SELECT * FROM temas WHERE Grupo = :id AND IDTEMA = :tema";
                $esteResultado = $conection->prepare($otraQuery);
                $esteResultado->bindValue(":id", $_SESSION['grupo']);
                $esteResultado->bindValue(":tema",  $tema);
                $esteResultado->execute();
                
                while($otrosDatos = $esteResultado->fetch(PDO::FETCH_ASSOC)){
                    $nombreTema = $otrosDatos['Titulo'];
                    $descripcionTema = $otrosDatos['Descripcion'];
                }

                $filas = $esteResultado->rowCount();
            }
            
        ?>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">

                    <div class="row mb-2">
                        <div class="col-sm-6 row">
                            <h1 class="mx-2 text-dark"><?php print_r($nombreTema)?></h1>
                            <p class="mx-2 text-muted pt-2">«<?php print_r(" $descripcionTema ");?>»</p>
                        </div>
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="NetWork"> Tablero </a></li>
                                <li class="breadcrumb-item active"> Tareas </li>
                            </ol>
                        </div>
                        <!-- aqui comienza el formulario-->
                        <div class="container p-4">
                            <div class="row">
                                <div class="container">
                                    <!-- sugerencia usar la clase col-md-4--><!-- aqui para lo de reconocimiento de voz-->
                                    <div class="card card-body">
                                        <p>Crear Tarea</p>
                                        <form action="#" method="POST" id="formGuardarTarea">
                                            <div class="form-group">
                                                <input type="text" maxlength="128" minlength="4" id="inTitulo"
                                                    name="titulo" class=" form-control" placeholder=" T&iacute;tulo"
                                                    required>
                                                    
                                                    <button type="button" id="titleButton" class="btn btn-info mic"><i class="fas fa-microphone"></i></button>
                                                    
                                            </div>
                                            <div class="form-group">
                                                <textarea name="descripcion" maxlength="256" id="inDesc" rows="4"
                                                    class="form-control" placeholder="Descripci&oacute;n"
                                                    required></textarea>
                                                    <button type="button" id="descripButton" class="btn btn-info mic"><i class="fas fa-microphone"></i></button>
                                                   
                                            </div>
                                            <div class="form-group">
                                                <input type="date" id="inFecha" name="fecha" class=" form-control"
                                                    placeholder=" Fecha L&iacute;mite">
                                            </div>
                                            <input type="button" class="btn btn-success btn-guardar btn-block"
                                                id="btnGuardarTarea" name="guardarTarea" value="Guardar Tarea">

                                        </form>
                                    </div>
                                </div>
                                <div class="container">
                                    <table class="table table-bordered mis-tareas" class="display" id="mitabla">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">T&iacute;tulo</th>
                                                <th class="text-center">Descripci&oacute;n</th>
                                                <th class="text-center" style="min-width: 100px;">Fecha L&iacute;mite
                                                </th>
                                                <th class="text-center" style="min-width: 45px;"> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody class="lista-tareas">
                                            <?php
                                           
                                            if($filas != 0){
                                                $query = "SELECT * FROM tareas WHERE eltema = :tema";
                                                $resultado_tarea = $conection->prepare($query);
                                                
                                                $resultado_tarea->bindValue(":tema", $tema);
                                                $resultado_tarea->execute();
                                                while($row = $resultado_tarea->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr class="item-tarea">
                                                <td><?php print_r($row['title']); ?></td>
                                                <td><?php print_r($row['description']); ?></td>
                                                <td class="text-center"><?php print_r($row['limit_date']); ?></td>
                                                <td class="text-center">

                                                    <span class="span-btn-opciones"><i
                                                            class="fa fa-ellipsis-v btn-opciones"
                                                            data-tid="<?php print_r($row['id_task']);?>"
                                                            aria-hidden="true"></i></span>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            }
                                            else{
                                                ?>
                                            <script>
                                            function getAbsolutePath() {
                                                var loc = window.location;
                                                var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') +
                                                    1);
                                                return loc.href.substring(0, loc.href.length - ((loc.pathname + loc
                                                    .search + loc.hash).length - pathName.length));
                                            }
                                            window.location.replace(getAbsolutePath() + "MisEquipos");
                                            </script>
                                            <?php    
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <!--opcion de editar-->
                        <div class="overlay " id="overlay">
                            <div class="popup " id="popup">

                                <div class="col sm-4">
                                    <a href="#" class=" btn-cerrar-popup"><i class="far fa-times-circle"></i></a>
                                    <div class="row">
                                        <div class="card card-body col-10">

                                            <form action="#" method="POST" id="formEditarTarea">
                                                <div class="form-group">
                                                    <input type="text" name="titulo2" maxlength="128" minlength="4"
                                                        class=" form-control" id="inEditTitulo" placeholder=" Título">
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="descripcion2" maxlength="256" rows="4"
                                                        class="form-control" id="inEditDesc" placeholder="Descripcion">
                                                    </textarea>

                                                </div>
                                                <div class="form-group">
                                                    <input type="date" name="fecha2" id="inEditFecha"
                                                        class=" form-control">
                                                </div>
                                                <input type="button"
                                                    class="btn btn-config btn-editar btn-light btn-block" name="update"
                                                    value="Editar Tarea" />

                                            </form>

                                        </div>
                                        <div class="botones-popup col-2">
                                            <div class="popup-boton">
                                                <a href="#" class="btn-eliminar btn btn-secondary"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Eliminar </a>
                                            </div>
                                            <div class="popup-boton">
                                                <a href="#" class=" btn-archivar btn btn-secondary"><i
                                                        class="fa fa-archive" aria-hidden="true"></i> Archivar </a>
                                            </div>
                                            <div class="popup-boton">
                                                <a href="#" class="btn btn-secondary"><i class="fa fa-circle"
                                                        aria-hidden="true"></i> Estado </a>
                                                <div class="nombre-estados">
                                                    <input type="radio" name="estado" value="Sin hacer"> Sin hacer<br>
                                                    <input type="radio" name="estado" value="Haciendo"> Haciendo<br>
                                                    <input type="radio" name="estado" value="Hecho"> Hecho<br>
                                                </div>
                                            </div>
                                            <div class="popup-boton">
                                                <a href="#" class="btn btn-secondary"><i class="fa fa-paperclip"
                                                        aria-hidden="true"></i> Adjuntar</a>
                                            </div>
                                            <div class="popup-boton">
                                                <a href="#" class="btn btn-secondary"><i class="fa fa-arrow-right"
                                                        aria-hidden="true"></i> Mover </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!--Aqui termina el formulario-->

                    </div>
                </div>

            </div>

        </div>

        <?php 

            if(!empty($_SESSION['grupo'])){
            ?>
        <div class="btn-chat" id="g-<?php print_r($_SESSION['grupo'])?>">
            <span class="notificaciones"></span>
            <i class="fas fa-comment-dots"></i>
        </div>
        <div id="Michat">
            <div class='opciones-chat'>
                <i class='fas fa-minus' id='minimizar-chat'></i>
            </div>

            <div class="panel panel-success">
                <div class="panel-body">
                    <ul class="list-group" id="listaOnline"></ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="chat-grupal-todo cuerpo-chat">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <ul class="chatpluginchat">

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="txtMensaje" type="text" class="form-control input-sm"
                                placeholder="Escribe un mensaje..." />
                            <span class="emojis">
                                <i class="fas fa-smile-beam"></i>
                                <emoji-picker></emoji-picker>
                            </span>
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btnEnviar">Enviar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <li class="left clearfix itemtemplate" style="display:none">
                <span class="chat-img pull-left">
                    <img src="<?php print_r($uFoto)?>" alt="User Avatar" class="img-circle" id="Foto" />
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font" id="Nombre"><?php print_r($uNombre)?></strong>
                        <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-asterisk"></span>
                            <span id="Tiempo">12 mins ago</span>
                        </small>
                    </div>
                    <p id="Contenido">Contenido</p>
                </div>
            </li>
        </div>

        <?php
            }            
            ?>


    </div>


    <footer class="main-footer">
        <strong> &copy; 2020-2021 <a href="#">Todo List</a>.</strong>
        Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versi&oacute;n</b> 2.0
        </div>
    </footer>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../scripts/Tarea.js"></script>
    <?php 

        if(!empty($_SESSION['grupo'])){
        ?>
    <script src="../scripts/MiChat.js"></script>
    <?php
        }
    ?>

    <script>
    $.widget.bridge('uibutton', $.ui.button)
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
    <script src="../../plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="../scripts/activadorPopUp.js"></script>
    <script>
    $(document).ready(function() {
        $('#mitabla').DataTable({
            //"order": [[1, "asc"]],
            "language": {
                "EmptyTable": 'No existen tareas',
                "lengthMenu": "Mostrar _MENU_ tareas",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "",
                "searchPlaceholder": "Buscar",
                "zeroRecords": "No se encontraron tareas",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                },
            }
        });
    });
    </script>

    <script src="../scripts/reconocimientoPorVoz.js"></script>
    <script src="../scripts/reconocimientoDeVozDescripcion.js"></script>
</body>

</html>
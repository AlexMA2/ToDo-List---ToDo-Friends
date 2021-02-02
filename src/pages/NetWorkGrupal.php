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

                                        <form action="" method="POST" id="CTema">
                                            <div class="form-group">
                                                <input type="text" name="Titulo3" maxlength="16" minlength="4"
                                                    class=" form-control" id="inTemaTitulo"
                                                    placeholder=" T&iacute;tulo">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="Descripcion3" maxlength="32" rows="4"
                                                    class="form-control" id="inTemaDesc"
                                                    placeholder="Descripci&oacute;n"></textarea>
                                            </div>
                                            <input type="button" class="btn btn-config btn-light btn-block"
                                                name="CrearTema" id="btn-crear-temagrupal" value="Crear Tema" />

                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 row">

                            <h1 class="text-dark titulo-principal"> Temas de Trabajo de Equipo </h1>
                            <h3> &nbsp;( <?php print_r($resultado_tema->rowCount())?> )</h3>
                            <button class="btn-opciones btn btn-success mx-2"> Crear Tema </button>
                            <!--div class="color-picker"></div-->
                        </div>
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="MisEquipos"> Equipos </a></li>
                                <li class="breadcrumb-item active"> Temas del equipo </li>
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
            <div class="card card-body col-4 add-member">
                <table class="table table-bordered " class="display" id="mitabla">
                    <h4 class="text-center"> Integrantes</h4>
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Nombre de usuario</th>
                            <?php
                            if($_SESSION['user']==$uID5){

                        ?>
                            <th class="text-center">Acci&oacute;n</th>
                            <?php                                
                        }
                        ?>
                        </tr>
                    </thead>
                    <tbody class="lista-tareas">
                        <tr>
                            <td><?php print_r($uNombre5) ;?>
                                <div class="float-right">
                                    <i class="fas fa-crown"></i>
                                </div>
                            </td>
                            <?php
                            if($_SESSION['user']==$uID5){
                            ?>
                            <td>
                                <!-- aqui pongan su wea-->
                                <div class="float-left">
                                    <a style="text-decoration:none" class="btn btn-sm" href=""><i
                                            class="fas fa-comment"></i></a>
                                    <a style="text-decoration:none" class="btn btn-sm" href=""><i
                                            class="fas fa-comment-slash"></i></a>
                                </div>
                                <div class="float-right">
                                    <a style="text-decoration:none" class="btn btn-danger btn-sm"
                                        href="eliminarIntegrante.php?IDdelete=<?php print_r($uID5);?>"><i
                                            class="fas fa-trash"></i> </a>
                                </div>
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
                                <div class="float-left">
                                    <a style="text-decoration:none" class="btn btn-sm" href=""><i
                                            class="fas fa-comment"></i></a>
                                    <a style="text-decoration:none" class="btn btn-sm" href=""><i
                                            class="fas fa-comment-slash"></i></a>
                                </div>
                                <div class="float-right">
                                    <a style="text-decoration:none" class="btn btn-danger btn-sm"
                                        href="eliminarIntegrante.php?IDdelete=<?php print_r($uID2);?>"><i
                                            class="fas fa-trash"></i> </a>
                                </div>
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
                            return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash)
                                .length - pathName.length));
                        }
                        window.location.replace(getAbsolutePath() + "MisEquipos");
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
                <table class="table table-bordered " class="display" id="mitabla">
                
                    <h4 class="text-center"> Solicitudes de ingreso</h4>
                    <thead class="thead-dark">
                    
                    </thead>
                    <tbody class="lista-tareas">
                    <?php
                                           
                                           if($_SESSION['grupo'] != 0){
                                               $query = "SELECT * FROM solicitudes WHERE IDGrupo = :grupo";
                                               $resultado_tarea = $conection->prepare($query);
                                               
                                               $resultado_tarea->bindValue(":grupo", $_SESSION['grupo']);
                                               $resultado_tarea->execute();
                                               while($row = $resultado_tarea->fetch(PDO::FETCH_ASSOC)) {
                                                   list ($uIDSte, $uNombreSte, $uCorreoSte, $uFotoSte) = getInfoSobre($row['IDSolicitante']);
                                                   list ($uIDSdo, $uNombreSdo, $uCorreoSdo, $uFotoSdo) = getInfoSobre($row['IDSolicitado']);
                                                   
                                                   ?>
                   
                                           <tr class="item-tarea">
                                                <td><?php print_r($uNombreSte); ?> <i class="fas fa-arrow-circle-right"></i> <?php print_r($uNombreSdo); ?> </td>
                                                <td>
                                                <a style="text-decoration:none" class="btn btn-success"
                                                    href="aceptarSolicitud.php?IDSoldo=<?php print_r($uIDSdo);?>"><i class="fas fa-check-circle"></i></a>
                                                <a style="text-decoration:none" class="btn btn-danger"
                                                    href="denegarSolicitud.php?IDSoldo=<?php print_r($uIDSdo);?>"><i class="fas fa-times-circle"></i></a>

                                                </td>
                                           </tr>
                                           
                                                
                                           <?php 
                                               }
                                           }
                                           ?>
                                          
                    </tbody>
                            
                </table>
                <div class="card card-body">

                    <form action="agregarIntegrante.php" method="POST" id="guardarAmigo">


                        <p>Añadir integrantes</p>
                        <div class="form-group">
                            <input type="email" name="emailAmigo" class="form-control" id="idEmailAmigo"
                                placeholder="Escribe el correo">
                        </div>
                        <input type="submit" class="btn btn-config btn-light btn-block" name="btnAddAmigo"
                            value="Añadir" />
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
            }else{?>

                <div class="card card-body">
                    <form action="soliciarIntegrante.php"method="POST" id="solicitarAmigo">
                    <p class="text-center">¿Deseas unir algún integrante?</p>
                        <div class="form-group">
                            <input type="email" name="idEmailSolicitud" class="form-control" id="idEmailSolicitud"
                                placeholder="Escribe el correo">
                        </div>
                        <input type="submit" class="btn btn-config btn-light btn-block" name="btnSolicitar" id="btnSolicitar"
                            value="Solicitar" />
                    </form>
                </div>
                <a style="text-decoration:none" class="btn btn-danger"
                    href="eliminarIntegrante.php?IDdelete=<?php print_r($_SESSION['user']);?>"><i
                        class="fas fa-sign-out-alt"></i> Salir del grupo </a>
                <?php
            }
            ?>
            </div>

            <!-- aqui termina añadir contactos-->

        </div>

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

    </div>

    <footer class="main-footer">
        <strong> &copy; 2020-2021 <a href="#">Todo List</a>.</strong>
        Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versi&oacute;n</b> 2.0
        </div>
    </footer>

    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!--<script src="../scripts/MiChat.js"></script> -->
    <!--<script src="../scripts/solicitarUnirInttegrante.js"></script>-->
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

</body>

</html>
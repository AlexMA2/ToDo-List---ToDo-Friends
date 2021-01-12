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
?>
<!DOCTYPE html>
<html lang="en">

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
    <title>Todo List | Edita tus datos </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../styles/netWork.css">
    <link rel="stylesheet" href="../styles/perfil.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">    

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">


        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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

        <div class="overlay " id="overlay">
            <div class="popup " id="popup">

                <div class="col sm-2">
                    <a href="#" class=" btn-cerrar-popup"><i class="far fa-times-circle"></i></a>
                   <div class="info-eliminar-cuenta">
                        <h3> ¿Est&aacute;s seguro de querer eliminar t&uacute; cuenta?</h3>
                        <p> 
                            No podr&aacute;s volver a recuperar la cuenta y todos los datos 
                            se perder&aacute;n.
                        </p>
                       <div class="row">   
                            <a href="#" class="btn btn-secondary mx-2 confirmar-eliminar-micuenta"> S&iacute;, estoy seguro</a>    
                            <a href="perfilusuario" class="btn btn-primary mx-2"> No, no quiero eliminarla </a>      
                        </div> 
                       
                   </div>
                </div>
            </div>

        </div>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container">
                    <div class="row perfil-usuario">

                        <div class="perfil-foto col-6">
                            <img src="<?php print_r($uFoto)?>" id="foto-userperfil" alt="foto-perfil" class="img-thumbnail img-circle" width="350" height="350">
                            <form action="actualizarDatos.php" method="POST" enctype="multipart/form-data">
                                <input type="button" value="Cambiar foto de perfil" id="sub-subir-foto"
                                    class="btn btn-primary">                              
                            </form>

                        </div>
                        <div class="perfil-datos col-6">

                            <h3> Nombre de usuario: </h3>
                            <div class="perfil-nombre">
                                <form action="actualizarDatos.php" method="POST">
                                    <input type="text" id="in-perfil-nombre" name="perfil-nombre"
                                        value="<?php print_r($uNombre);?>">
                                    <input type="submit" id="btn-perfil-nombre" name="perfil-guardar-nombre"
                                        class="btn btn-primary" value="Cambiar">
                                </form>
                            </div>
                            <h3> Correo Electrónico: </h3>
                            <div class="perfil-correo">
                                <form action="actualizarDatos.php" method="POST">
                                    <input type="email" id="in-perfil-correo" name="perfil-correo"
                                        value="<?php print_r($uCorreo);?>">
                                    <input type="submit" id="btn-perfil-correo" name="perfil-guardar-correo"
                                        class="btn btn-primary" value="Cambiar">
                                </form>
                            </div>
                            <h3> Cambiar contraseña: </h3>
                            <div class="perfil-contra">
                                <form action="actualizarDatos.php" method="POST">
                                    <input type="password" name="perfil-contra" placeholder="Contraseña nueva" required
                                        value="">
                                    <input type="password" name="perfil-contra-repe"
                                        placeholder="Confirmar contraseña nueva" required value="">
                                    <input type="submit" class="btn btn-primary" name="perfil-guardar-contra"
                                        value="Cambiar Contraseña">
                                </form>
                            </div>
                        </div>
                        <a href="#" class="btn-eliminar-micuenta"><i class="fa fa-trash"></i> Eliminar cuenta</a>
                    </div>
                </div>
                
            </div>

        </div>

        <footer class="main-footer">
            <strong> &copy; 2020 <a href="#">Todo List</a>.</strong>
            Todos los derechos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Versi&oacute;n</b> 2.0
            </div>
        </footer>

    </div>
    
    <script src="../scripts/activadorPopUp.js"></script>
    <script src="../scripts/perfil.js"></script>
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
    
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script src="../scripts/imagen.js"></script>

</body>

</html>
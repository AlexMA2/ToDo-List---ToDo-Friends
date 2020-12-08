<?php
    session_start();           
    if(empty($_SESSION['user'])){
        header("location:../../index");
    }
     else{
        require "sacarDatos.php";
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
    <link rel="stylesheet" href="../../tapmodo-Jcrop-1902fbc/css/jquery.Jcrop.css">

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
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tablero
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> - </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> - </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> - </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                                <p>
                                    Mis Equipos
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="../../index" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>
                                    Salir
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container">
                    <div class="row perfil-usuario">
                        <div class="perfil-foto col-6">
                            <img src="<?php print_r($uFoto)?>" alt="foto-perfil" class="img-thumbnail img-circle" width="350"
                                height="350">
                            <form action="actualizarDatos.php" method="POST" enctype="multipart/form-data">
                                <input type="button" value="Cambiar foto de perfil" id="btn-perfil-foto" class="btn btn-primary">
                                <div id="para-animar">
                                    <input type="file" accept="image/*" id="in-perfil-foto" name="perfil-foto" >
                                    <input type="submit" name="perfil-guardar-foto" id="sub-guardar-foto" value="Guardar foto" class="btn btn-primary">
                                </div>                                
                            </form>
                            
                        </div>
                        <div class="perfil-datos col-6">
                            <h3> Nombre de usuario: </h3>
                            <div class="perfil-nombre">
                                <form action="actualizarDatos.php" method="POST">
                                    <input type="text" id="in-perfil-nombre" name="perfil-nombre" value="<?php print_r($uNombre);?>" >
                                    <input type="submit" id="btn-perfil-nombre" name="perfil-guardar-nombre" class="btn btn-primary" value="Cambiar">
                                </form>                              
                            </div>
                            <h3> Correo Electrónico: </h3>
                            <div class="perfil-correo">
                                <form action="actualizarDatos.php" method="POST">
                                    <input type="email" id="in-perfil-correo" name="perfil-correo" value="<?php print_r($uCorreo);?>" >
                                    <input type="submit" id="btn-perfil-correo" name="perfil-guardar-correo" class="btn btn-primary" value="Cambiar">
                                </form>
                            </div>
                            <h3> Cambiar contraseña: </h3>
                            <div class="perfil-contra">
                                <form action="actualizarDatos.php" method="POST">
                                    <input type="password" name="perfil-contra" placeholder="Contraseña nueva" required value="">
                                    <input type="password" name="perfil-contra-repe" placeholder="Confirmar contraseña nueva" required value="">
                                    <input type="submit" class="btn btn-primary" name="perfil-guardar-contra" value="Cambiar Contraseña">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container editor-img">
                    <?php 
                        if(!empty(filter_input(INPUT_GET, "errimg"))){
                           
                        ?>
                            
                            <img src="<?php print_r(filter_input(INPUT_GET, "errimg"))?>" id="target" alt="omg">                            
                            <input type="button" class="btn btn-success" value="Cortar"  id="btn-cortar-foto">                            
                            
                            <script>
                                $(".editor-img").css("visibility", "visible");
                            </script>
                        <?php
                        }
                        else{
                            
                        ?>
                        
                            <script>
                                $(".editor-img").css("visibility", "hidden");
                            </script>
                        <?php
                        }
                    ?>
                </div>
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

      
    <script src="../../tapmodo-Jcrop-1902fbc/js/jquery.Jcrop.min.js"></script>
    <script>
        var x = '';
        var y = '';
        var w = ''; 
        var h = '';
        var ruta = '<?php print_r(filter_input(INPUT_GET, "errimg"))?>';
        console.log(ruta);               
        function showCoords(c)
        {
            x = c.x;
            y = c.y;
            w = c.w;
            h = c.h;
        };

        jQuery(function($) {
            $('#target').Jcrop({
                onSelect: showCoords,
                bgColor: 'black',
                bgOpacity: .4,
                minSize: [300, 300],
                setSelect:   [ 100, 100, 50, 50 ],
                aspectRatio: 1
            });
        });

        $("#btn-cortar-foto").on('click', function(){
            enviar();
        });

        function enviar(){
            $.ajax({
                url: 'cortar.php',
                type: 'POST',
                data: 'x=' + x + '&y=' + y + '&w=' + w + '&h=' + h + '&ruta=' + ruta,
                success: function(rpt){
                    window.location.replace("http://localhost/ToDo-List---ToDo-Friends/src/pages/perfilusuario");
                }
            });
        }

    </script>
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



</body>

</html>
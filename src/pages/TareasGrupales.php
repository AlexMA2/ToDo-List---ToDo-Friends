<?php include("conexion.php"); ?>

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
    <link rel="stylesheet" href="../../src/styles/netWork.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
        session_start();           
        if($_SESSION['user']==NULL){
            header("location:../../index.php");
        }
    ?>
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
                        <img src="../../res/perfil.jpg" alt="User Image" class="img-circle elevation-2">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"> 
                            <?php                                  
                                echo $_SESSION['user']
                            ?> </a>
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
                            <a href="../../index.php" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>
                                    Salir                                    
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            </ul>
                        </li>                     
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Tema de trabajo</h1>
                        </div>
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"> Inicio </a></li>
                                <li class="breadcrumb-item active"> Tareas </li>
                            </ol>
                        </div>
                        <!-- aqui comienza el formulario-->
                        <div class="container p-4">
                            <div class="row">
                                <div class="container">
                                    <!-- sugerencia usar la clase col-md-4-->
                                    <div class="card card-body">
                                        <p>Crear Tarea</p>
                                        <form action="guardartarea.php" method = "POST" id="formGuardarTarea">
                                            <div class="form-group">
                                                <input type="text" maxlength="128" minlength="4" id="inTitulo"
                                                    name="titulo" class=" form-control" placeholder=" T&iacute;tulo"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="descripcion" maxlength="256" id="inDesc" rows="4"
                                                    class="form-control" placeholder="Descripci&oacute;n"
                                                    required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="date" id="inFecha" name="fecha"
                                                    class=" form-control" placeholder=" Fecha Limite">
                                            </div>
                                            <input type="submit" class="btn btn-success btn-block" id="btnGuardarTarea"
                                                name = "guardarTarea" value ="Guardar Tarea">

                                        </form>
                                    </div>
                                </div>
                                <div class="container">
                                    <table class="table table-bordered mis-tareas">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>T&iacute;tulo</th>
                                                <th>Descripci&oacute;n</th>
                                                <th>Fecha L&iacute;mite</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="lista-tareas">
                                        <?php
                                           
                                            $query = "SELECT * FROM tareas";
                                            $resultado_tarea = $conection->query($query);
                                            while($row = $resultado_tarea->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr class="item-tarea">
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['limit_date']; ?></td>
                                                <td>
                                                    <abbr title="Modificar Tarea">
                                                    <a href="#" class="btn btn-warning btn-editar"  id="t-<?php echo $row['id_task'];?>"><i class="fas fa-pen btn-editar"  id="ti-<?php echo $row['id_task'];?>"></i></a>
                                                    </abbr>
                                                    <abbr title="Eliminar Tarea">
                                                    <a href="eliminartarea.php?id=<?php echo $row['id_task'];?>" class="btn btn-danger btn-eliminar"><i class="fas fa-trash btn-eliminar"></i></a>
                                                    </abbr>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <!--opcion de editar-->
                        <div class="overlay" id="overlay">
                            <div class="popup" id="popup">

                                <div class="col sm-4">
                                    <a href="#" class=" btn-cerrar-popup"><i class="far fa-times-circle"></i></a>
                                    <div class="card card-body mx-auto">
                                        <div class="card card-body">
                                            <p>Editar Tarea</p>
                                            <form action="graneditar.php" method = "POST" id="formEditarTarea">
                                                <div class="form-group">
                                                    <input type="text" name="titulo2" maxlength="128" minlength="4" class=" form-control"
                                                        id="inEditTitulo" placeholder=" Título">
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="descripcion2" maxlength="256" rows="4" class="form-control"
                                                        id="inEditDesc" placeholder="Descripcion"></textarea>

                                                </div>
                                                <div class="form-group">
                                                    <input type="date" name="fecha2" id="inEditFecha" class=" form-control">
                                                </div>
                                                <input type="submit" class="btn btn-config btn-light btn-block"
                                                    name="update" value="Guardar Cambios" />

                                            </form>
                                        </div>
                                    </div>
                                
                            </div>

                        </div>
                        <!--Aqui termina el formulario-->

                    </div>
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

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../scripts/Tarea.js"></script>
    <script src="../scripts/activadorPopUp.js"></script>
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


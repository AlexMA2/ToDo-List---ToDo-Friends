<?php
include("conexion.php");
#$include("login.php");
#$usuario=$_POST['user'];


/*if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM `tareas` WHERE `id_task`=:id";
  $resultadousuario = $conection->prepare($query);
  $resultadousuario->bindValue(":id", $id);
  $resultadousuario->execute();
  if ($resultadousuario->rowCount() == 1) {
    $row = $resultadousuario->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $description = $row['description'];
    $fecha = $row['limit_date'];
  }
}*/

if (isset($_POST['update'])) {
  try{
        $id = $_GET['id'];
        $title = htmlentities(addslashes($_POST['titulo2']));
        $description = htmlentities(addslashes($_POST['descripcion2']));
        $date = htmlentities(addslashes($_POST['fecha2']));

        $query = "UPDATE `tareas` set `title` = :title, `description` = :descripcion, `limit_date` = :fecha WHERE `id_task`= :id";
        $resultadoupdate = $conection->prepare($query);
        $resultadoupdate->bindValue(":title", $title);
        $resultadoupdate->bindValue(":descripcion", $description);
        $resultadoupdate->bindValue(":fecha", $date);
        $resultadoupdate->bindValue(":id", $id);
        $resultadoupdate->execute();
        header('location:TareasGrupales.php');

  }catch(Exception $ex){
      die("Error al conectar:  $ex->getMessage()");
  }  
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
                        <img src="../../res/perfil.jpg" alt="User Image">
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
                            <a href="#" class="nav-link">
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
                        <div class="container p-4">
                            <div class="row">
                                <div class="container">
                                    <!-- sugerencia usar la clase col-md-4-->
                                    <div class="card card-body">
                                        <p>Editar Tarea</p>
                                        <form action="editartarea.php?id=<?php echo $_GET['id']; ?>" method = "POST" id="formGuardarTarea">
                                            <div class="form-group">
                                                <input type="text" maxlength="128" minlength="4" id="inTitulo"
                                                    name="titulo2" class=" form-control" placeholder=" T&iacute;tulo"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="descripcion2" maxlength="256" id="inDesc" rows="4"
                                                    class="form-control" placeholder="Descripci&oacute;n"
                                                    required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="date" id="inFecha" name="fecha2"
                                                    class=" form-control" placeholder=" Fecha Limite">
                                            </div>
                                            <input type="submit" class="btn btn-success btn-block" id="btnGuardarTarea"
                                                name = "update" value ="Guardar Tarea">

                                        </form>
                                    </div>
                                </div>
                              
                            </div>

                        </div>
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
    <script src="../scripts/dashboard2.0.js"></script>                                      
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
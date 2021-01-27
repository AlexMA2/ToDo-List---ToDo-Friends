<?php
    session_start();       
    require "conexion.php";    
    if(empty($_SESSION['user']) || $_SESSION['nivel'] != 1){
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
    <link rel="stylesheet" href="../styles/panelAdmin.css">

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">


        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pushmen" data-widget="pushmenu" href="" role="button">
                    <i class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">

                </li>
            </ul>


            <form class="form-inline ml-3">
                <!--<div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Buscar"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>-->
            </form>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    ToDo Friends
                        <i class="fas fa-check-circle"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="" class="brand-link">
                <img src="../../res/favicon1.png" alt="Todo List" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">ToDo List</span>
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

        <div class="overlay " id="overlay">
            <div class="popup " id="popup">

                <div class="col sm-2">
                    <a href="#" class=" btn-cerrar-popup"><i class="far fa-times-circle"></i></a>
                   <div class="info-eliminar-cuenta">
                        <h3> ¿Est&aacute;s seguro(a) de eliminar este usuario?</h3>
                        <p> 
                            No se podr&aacute; volver a recuperar el usuario y todos sus datos 
                            se perder&aacute;n.
                        </p>
                       <div class="row">   
                            <a href="#" class="btn btn-danger mx-2 confirmar-eliminar-cuenta">S&iacute;, estoy seguro(a)</a>    
                            <a href="panelAdmin" class="btn btn-primary mx-2">No, no quiero eliminarlo </a>      
                        </div> 
                       
                   </div>
                </div>
            </div>

        </div>

        <div class="overlay " id="overlaygrupo">
            <div class="popup " id="popupgrupo">

                <div class="col sm-2">
                    <a href="#" class="btn-cerrar-popupgrupo"><i class="far fa-times-circle"></i></a>
                    <!--<a href="#"></a>-->
                   <div class="info-eliminar-grupo">
                        <h3> ¿Est&aacute;s seguro(a) de eliminar este equipo?</h3>
                        <p> 
                            No se podr&aacute; volver a recuperar el equipo y todos sus datos 
                            se perder&aacute;n.
                        </p>
                       <div class="row">   
                            <a href="#" class="btn btn-danger mx-2 confirmar-eliminar-grupo">S&iacute;, estoy seguro(a)</a>    
                            <a href="panelAdmin" class="btn btn-primary mx-2">No, no quiero eliminarlo </a>      
                        </div> 
                       
                   </div>
                </div>
            </div>

        </div>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid row">
                    <div class="panel-usuarios col-6">
                        <h2 class="text-center"> Lista de usuarios </h2>
                        <div class="lista-usuarios">
                            <table class="table table-bordered mis-tareas" class="display" id="mitabla">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 10%;" class="text-center"> ID </th>
                                        <th style="width: 10%;" class="text-center"> Foto </th>
                                        <th style="width: 25%;" class="text-center"> Usuario </th>
                                        <th style="width: 25%;" class="text-center"> Correo </th>
                                        <th style="width: 10%;" class="text-center"> Acci&oacute;n </th>
                                    </tr>
                                </thead>
                                <tbody class="tabla-usuarios">
                                    <?php                                           
                                       
                                        $query = "SELECT * FROM usuarios";
                                        $resultado = $conection->query($query);                
                                        $resultado->execute();
                                        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) { 
                                            if($row['iduser'] != $_SESSION['user']){
                                                ?>
                                                <tr id="<?php print_r($row['iduser']); ?>">
                                                    <td class="text-center"><?php print_r($row['iduser']); ?></td>
                                                    <td class="text-center"><img src="<?php print_r($row['Foto']); ?>" alt="user-img" width="50" height="50"></td>
                                                    <td><?php print_r($row['username']); ?></td>
                                                    <td><?php print_r($row['correo']); ?></td>
                                                    <td class="text-center user-opciones">
                                                        <a href="#" class="btn-eliminar-cuenta"><i class="fas fa-trash mx-2"></i></a>                                                       
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-grupos col-6">
                        <h2 class="text-center"> Lista de equipos </h2>
                        <div class="lista-grupos">
                            <table class="table table-bordered mis-tareas" class="display" id="mitabla">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 10%;" class="text-center"> ID </th>
                                        <th style="width: 20%;" class="text-center"> Nombre </th>
                                        <th style="width: 10%;" class="text-center"> Temas </th>
                                        <th style="width: 10%;" class="text-center"> Miembros </th>
                                        <th style="width: 10%;" class="text-center"> Creaci&oacute;n </th>
                                        <th style="width: 10%;" class="text-center"> Acci&oacute;n </th>
                                    </tr>
                                </thead>
                                <tbody class="tabla-grupos">
                                    <?php                                           
                                       
                                        $query = "SELECT * FROM grupos";
                                        $resultado = $conection->query($query);                
                                        $resultado->execute();
                                        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) { 
                                                ?>
                                                    <tr id="<?php print_r($row['IDGRUPO']); ?>">
                                                    <td class="text-center"><?php print_r($row['IDGRUPO']); ?></td>
                                                    <td><?php print_r($row['Nombre']); ?></td>
                                                    <td><?php print_r($row['Temas']); ?></td>
                                                    <td><?php print_r($row['Miembros']); ?></td>
                                                    <td><?php print_r($row['Creacion']); ?></td>
                                                    <td class="text-center user-opciones">
                                                        <a href="#" class="btn-eliminar-grupo"><i class="fas fa-trash mx-2"></i></a>                                                     
                                                    </td>
                                                </tr>
                                                <?php 
                                        
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <footer class="main-footer">
            <strong> &copy; 2020-2021 <a href="">ToDo Friends</a>.</strong>
            Todos los derechos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <!--<b>Versi&oacute;n</b> 2.0-->
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
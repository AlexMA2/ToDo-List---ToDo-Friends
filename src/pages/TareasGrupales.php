﻿<?php
    require "conexion.php";
    session_start();           
    if(!isset($_SESSION['user']) || !isset($_GET['tema']) ){
        header("location: NetWork");
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
    <link rel="stylesheet" href="../../src/styles/netWork.css">
    <link rel="stylesheet" href="../../plugins/datatable/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
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

            <!--
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
            -->

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
                    <!--
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
                                    <a href="tareas.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> - </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="horarios.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> - </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="guardado.html" class="nav-link">
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
                    -->
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
                                    <a href="#"class="text-truncate">PrimeroPrimeroP(19)</a>
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
            $tema = filter_input(INPUT_GET, 'tema', FILTER_SANITIZE_NUMBER_INT);
            $_SESSION['tema'] = $tema;
            if(empty(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))){
                $otraQuery = "SELECT * FROM temas WHERE Usuario = :id AND IDTEMA = :tema";
                $esteResultado = $conection->prepare($otraQuery);
                $esteResultado->bindValue(":id",  $_SESSION['user']);
                $esteResultado->bindValue(":tema",  $tema);
                $esteResultado->execute();
                
                while($otrosDatos = $esteResultado->fetch(PDO::FETCH_ASSOC)){
                    $nombreTema = $otrosDatos['Titulo'];
                }

                $filas = $esteResultado->rowCount();
            }
            else{
                $otraQuery = "SELECT * FROM temas WHERE Grupo = :id AND IDTEMA = :tema";
                $esteResultado = $conection->prepare($otraQuery);
                $esteResultado->bindValue(":id", filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT) );
                $esteResultado->bindValue(":tema",  $tema);
                $esteResultado->execute();
                
                while($otrosDatos = $esteResultado->fetch(PDO::FETCH_ASSOC)){
                    $nombreTema = $otrosDatos['Titulo'];
                }

                $filas = $esteResultado->rowCount();
            }
            
        ?>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><?php print_r($nombreTema)?></h1>
                        </div>
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="NetWork"> Tablero </a></li>
                                <li class="breadcrumb-item active"> Tema </li>
                            </ol>
                        </div>
                        <!-- aqui comienza el formulario-->
                        <div class="container p-4">
                            <div class="row">
                                <div class="container">
                                    <!-- sugerencia usar la clase col-md-4-->
                                    <div class="card card-body">
                                        <p>Crear Tarea</p>
                                        <form action="guardartarea.php?grupo=<?php print_r(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))?>" method = "POST" id="formGuardarTarea">
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
                                    <table class="table table-bordered mis-tareas" class="display" id="mitabla">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>T&iacute;tulo</th>
                                                <th>Descripci&oacute;n</th>
                                                <th style="min-width: 120px;" >Fecha L&iacute;mite</th>
                                                <th>Acciones</th>
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
                                                        <td><?php print_r($row['limit_date']); ?></td>
                                                        <td>
                                                            
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
                                                    window.location.replace("http://localhost/ToDo-List---ToDo-Friends/src/pages/NetWork");
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

                                            <form action="graneditar.php?grupo=<?php print_r(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))?>" method="POST" id="formEditarTarea">
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
                                                <input type="submit" class="btn btn-config btn-light btn-block"
                                                    name="update" value="Editar Tarea" />

                                            </form>

                                        </div>
                                        <div class="botones-popup col-2">
                                            <div class="popup-boton">
                                                <a href="eliminartarea.php?grupo=<?php print_r(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))?>" class="btn-eliminar btn btn-secondary"><i class="fa fa-trash"
                                                        aria-hidden="true"></i> Eliminar </a>
                                            </div>
                                            <div class="popup-boton">
                                                <a href="archivartareas.php?grupo=<?php print_r(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))?>" class=" btn-archivar btn btn-secondary"><i class="fa fa-archive"
                                                        aria-hidden="true"></i> Archivar </a>
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
    <script src="../../plugins/datatable/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function(){
		$('#mitabla').DataTable({
			//"order": [[1, "asc"]],
			"language":{
				"lengthMenu": "Mostrar _MENU_ tareas",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "No hay tareas disponibles",
				"infoFiltered": "(filtrada de _MAX_ tareas)",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search": "Buscar:",
				"zeroRecords":    "No se encontraron tareas coincidentes",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			}
		});	
	});	
    </script>



</body>
</html>


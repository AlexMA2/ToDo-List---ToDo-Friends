<?php
    session_start();         
    require "conexion.php";
    if(empty($_SESSION['user'])){
        header("location:../../index");
    }
    else{
        require "sacarDatos.php";  
        list ($uID, $uNombre, $uCorreo, $uFoto) = getInfoSobre($_SESSION['user']);
    }
    $query = "SELECT * FROM grupos WHERE Dueno = :id";
    $resultado_misgrupos = $conection->prepare($query);
    $resultado_misgrupos->bindValue(":id", $_SESSION['user']);
    $resultado_misgrupos->execute();
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
    <link rel="stylesheet" href="../styles/MisEquipos.css">
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

                                        <form action="#" method="POST" id="CTema">
                                            <div class="form-group">
                                                <input type="text" name="Titulo4" maxlength="128" minlength="4" required
                                                    class=" form-control" id="inGrupoTitulo"
                                                    placeholder="Nombre">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="Descripcion4" maxlength="256" rows="4"
                                                    class="form-control" id="inGrupoDesc" value="Descripcion"
                                                    placeholder="Descripci&oacute;n"></textarea>

                                            </div>

                                            <input type="button" class="btn btn-config btn-light btn-block btn-crear-grupo"
                                                name="CrearGrupo" value="Crear equipo" />
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 row">
                            
                            <h1 class="text-dark titulo-principal"> Mis Equipos </h1>
                            <h3 id="contador"> &nbsp;( <?php print_r($resultado_misgrupos->rowCount())?> )</h3>
                            <button class="btn-opciones btn btn-success mx-2"> Crear Equipo </button>

                            <!--div class="color-picker"></div-->
                        </div>
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="NetWork"> Mis Equipos </a></li>
                                <li class="breadcrumb-item"> Temas del equipo </li>
                            </ol>
                        </div>



                    </div>
                </div>
                <div class="grupo-grupos">

                    <!-- Imprimir grupos donde tu eres el Lider -->
                    <?php                                           
                       
                        while($row = $resultado_misgrupos->fetch(PDO::FETCH_ASSOC)) {                            
                    ?>
                    <div class="unidad-grupo">
                        <div class="small-box bg-info miGrupo">
                            <div class="titulo-grupo">
                                <i class="fas fa-users"></i>
                                <h3><?php print_r($row['Nombre']); ?></h3>
                            </div>

                            <div class="inner row">
                                <div class="inner-izquierda col-7">
                                    <p><?php print_r($row['Descripcion']); ?></p>
                                </div>
                                <div class="inner-derecha col-5">
                                    <p>Dueño: <span><?php if($_SESSION['user'] == $row['Dueno']){
                                        print_r("Tú");
                                    }
                                    else{
                                        print_r(getInfoSobre($row['Dueno'])[1]);                                        
                                    } ?></span></p>
                                    <p>Temas: <span><?php print_r($row['Temas']); ?></span> </p>
                                    <p>Tareas: <span><?php print_r($row['Tareas']); ?></span> </p>
                                    <p>Miembros: <span><?php print_r($row['Miembros']); ?> </span></p>
                                    <p>Creado el: <span><?php print_r($row['Creacion']); ?></span> </p>
                                </div>

                            </div>
                        </div>
                        <div class="botones-grupo">
                            <a href="#" id="del-<?php print_r($row["IDGRUPO"]);?>"
                                class="small-box-footer btn-eliminar-migrupo"> Eliminar equipo
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="NetWorkGrupal" id="ver-<?php print_r($row["IDGRUPO"]);?>"
                                class="small-box-footer btn-ver-grupo"> Ver equipo
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                            <a href="#" data-id1="<?php print_r($row["IDGRUPO"]);?>"
                                class="small-box-footer btn-opcion2 "> Editar equipo
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>

                    </div>

                    <?php 
                        } 
                    ?>
                    <!--Botón de editar grupos-->
                    <div class="overlay " id="overlay2">
                        <div class="popup " id="popup2">

                            <div class="col sm-4">
                                <a href="#" class=" btn-cerrar-popup2"><i class="far fa-times-circle"></i></a>
                                <div class="row">
                                    <div class="card card-body col-12">

                                        <form action="#" method="POST" id="formEditarGrupo">
                                            <div class="form-group">
                                                <input type="text" name="Titulo4" maxlength="16" minlength="4"
                                                    class=" form-control" id="editTemaTitulo"
                                                    placeholder="Nuevo Título">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="Descripcion4" maxlength="32" rows="4"
                                                    class="form-control" id="editTemaDesc"
                                                    placeholder="Nueva Descripcion"></textarea>
                                            </div>
                                            <input type="button"
                                                class="btn-editar-grupo btn btn-config btn-light btn-block"
                                                name="EditarGrupo" value="Editar Grupo" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- aqui termina editar grupo-->    
                    <!-- Imprimir grupos donde tu eres un participante -->
                    <?php
                        $consulta="SELECT * FROM `otro_grupos` where `FKusuario`= :IDUser";
                        $resultado = $conection->prepare($consulta);              
                        $resultado->bindValue(":IDUser", $_SESSION['user']);                
                        $resultado->execute();                
                        $filas = $resultado->rowCount();

                        while($rpta=$resultado->fetch(PDO::FETCH_ASSOC)) {
                            
                            $query = "SELECT * FROM grupos WHERE IDGRUPO = :id";
                            $resultado_grupos = $conection->prepare($query);
                            $resultado_grupos->bindValue(":id", $rpta['FKgrupo']);
                            $resultado_grupos->execute();
                            while($row2 = $resultado_grupos->fetch(PDO::FETCH_ASSOC)) {
                        ?>

                    <div class="unidad-grupo">
                        <div class="small-box bg-info miTema">
                            <div class="titulo-grupo">
                                <i class="fas fa-users"></i>
                                <h3><?php print_r($row2['Nombre']); ?></h3>
                            </div>

                            <div class="inner row">
                                <div class="inner-izquierda col-7">
                                    <p><?php print_r($row2['Descripcion']); ?></p>
                                </div>
                                <div class="inner-derecha col-5">
                                    <p>Dueño: <span><?php if($_SESSION['user'] == $row2['Dueno']){
                                            print_r("Tú");
                                        }
                                        else{
                                            print_r(getInfoSobre($row2['Dueno'])[1]);
                                        } ?></span></p>
                                    <p>Temas: <span><?php print_r($row2['Temas']); ?></span> </p>
                                    <p>Tareas: <span><?php print_r($row2['Tareas']); ?></span> </p>
                                    <p>Miembros: <span><?php print_r($row2['Miembros']); ?> </span></p>
                                    <p>Creado el: <span><?php print_r($row2['Creacion']); ?></span> </p>
                                </div>

                            </div>
                        </div>
                        <div class="botones-grupo">                            
                            <a href="NetWorkGrupal" id="ver-<?php print_r($row2["IDGRUPO"]);?>"
                                class="small-box-footer btn-ver-grupo"> Ver equipo
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>                            
                        </div>                       
                    </div>
                    <?php }
                        } 
                    ?>
                    <!-- aqui termina mostrar grupos que e añadieron-->
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

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

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
    <script src="../../dist/js/demo.js"></script>
    
    <script src="../../dist/js/adminlte.js"></script>
    
    <script src="../scripts/activadorPopUp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    
</body>

</html>